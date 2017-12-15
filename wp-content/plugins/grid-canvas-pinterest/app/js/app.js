(function() {
  var $, AppView, Area, AreaList, AreaOptionView, AreaView, Areas, BaseAreaView, BaseGridView, BaseImageView, BaseOptionsView, Canvas, CanvasView, GridOption, GridOptionList, GridOptionView, GridOptions, GridOptionsView, ImageList, ImageModel, ImageOptionView, ImageOptions, ImageOptionsView, ImagePositioner, ImageView, SelectedImages, SizeOption, SizeOptionList, SizeOptionView, SizeOptions, SizeOptionsView, eventBus, gOptions,
    extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    hasProp = {}.hasOwnProperty;

  eventBus = _({}).extend(Backbone.Events);

  window.GRID_CANVAS = {};

  $ = jQuery;

  window.GridCanvasApp = (function(superClass) {
    extend(GridCanvasApp, superClass);

    function GridCanvasApp() {
      return GridCanvasApp.__super__.constructor.apply(this, arguments);
    }

    GridCanvasApp.prototype.selectors = {
      canvas: 'gc-canvas',
      leftSidebar: 'gc-left-sidebar',
      rightSidebar: 'gc-right-sidebar',
      canvasWrap: 'gc-canvas-wrap',
      center: 'gc-center',
      toolbar: 'gc-toolbar',
      generate: 'gc-generate',
      button: 'gc-button',
      centerContent: 'gc-center-content',
      sidebarFooter: 'gc-sidebar-footer'
    };

    GridCanvasApp.prototype.template = '<div class="<%= leftSidebar %>"></div> <div class="<%= center %>"> <div class="<%= centerContent %>"> <div class="<%= canvasWrap %>"> <div id="<%= canvas %>"></div> </div> </div> </div> <div class="gc-right-sidebar"> <div class="<%= toolbar %>"></div> </div> <div class="clear"></div>';

    GridCanvasApp.prototype.initialize = function(options) {
      return this.options = options;
    };

    GridCanvasApp.prototype.render = function() {
      var temp;
      temp = _.template(this.template);
      this.$el.append(temp(this.selectors));
      return this.init();
    };

    GridCanvasApp.prototype.init = function() {
      this.$leftSidebar = $("." + this.selectors.leftSidebar);
      this.$rightSidebar = $("." + this.selectors.rightSidebar);
      this.$toolbar = $("." + this.selectors.toolbar);
      this.$centerContent = $("." + this.selectors.centerContent);
      this.$canvasWrap = $("." + this.selectors.canvasWrap);
      this.initCanvas();
      this.initGridOptions();
      this.initSizeOptions();
      this.initImageOptions();
      this.addGenerateButton();
      return this.listenTo(eventBus, 'sizeChanged', this.onSizeChange);
    };

    GridCanvasApp.prototype.initGridOptions = function() {
      this.gridOptionsView = new GridOptionsView({
        collection: GridOptions
      });
      return this.$toolbar.append(this.gridOptionsView.render().el);
    };

    GridCanvasApp.prototype.initSizeOptions = function() {
      this.sizeOptionsView = new SizeOptionsView({
        collection: SizeOptions
      });
      return this.$toolbar.append(this.sizeOptionsView.render().el);
    };

    GridCanvasApp.prototype.initCanvas = function() {
      this.canvas = new Canvas({
        gridOption: GridOptions.models[0]
      });
      this.canvasView = new CanvasView({
        model: this.canvas,
        el: $("#" + this.selectors.canvas)
      });
      this.canvasView.render();
      return this.fitter = gc_fit(this.$canvasWrap[0], this.$centerContent[0], {
        watch: true,
        vAlign: gc_fit.TOP
      });
    };

    GridCanvasApp.prototype.initImageOptions = function() {
      var addCallback;
      addCallback = this.options.addImagesCallback || null;
      this.imageOptionsView = new ImageOptionsView({
        addCallback: addCallback
      });
      return this.$leftSidebar.append(this.imageOptionsView.render().el);
    };

    GridCanvasApp.prototype.addGenerateButton = function() {
      if (this.options.generateCallback != null) {
        return $('<div />', {
          'class': this.selectors.sidebarFooter
        }).appendTo(this.$rightSidebar).append($('<span />', {
          'id': this.selectors.generate,
          'class': this.selectors.button,
          text: GRID_CANVAS.strings.generateImage
        })).on('click', this.options.generateCallback);
      }
    };

    GridCanvasApp.prototype.onSizeChange = function() {
      return this.fitter.trigger();
    };

    GridCanvasApp.prototype.exportCanvas = function() {
      var areas, res;
      areas = Areas.exportData();
      return res = {
        size: {
          width: this.canvas.get('width'),
          height: this.canvas.get('height')
        },
        areas: areas
      };
    };

    return GridCanvasApp;

  })(Backbone.View);

  BaseOptionsView = (function(superClass) {
    extend(BaseOptionsView, superClass);

    function BaseOptionsView() {
      return BaseOptionsView.__super__.constructor.apply(this, arguments);
    }

    BaseOptionsView.prototype.optionType = 'none';

    BaseOptionsView.prototype.changeEvent = 'optionChange';

    BaseOptionsView.prototype.title = '';

    BaseOptionsView.prototype.selectors = {
      optionList: 'gc-options-list',
      optionTitle: 'gc-option-title',
      selectOption: 'gc-option-select',
      arrow: 'gc-option-select-arrow',
      visibleClass: 'gc-option-list-visible'
    };

    BaseOptionsView.prototype.initialize = function(options) {
      if (!((this.collection != null) && this.collection.length)) {
        throw "No options defined";
      }
      if (this.singleOptionView == null) {
        throw "Missing child property singleOptionView";
      }
      this.selectedOption = options.selectedOption != null ? options.selectedOption : this.collection.at(0);
      this.listenTo(eventBus, this.changeEvent, this.onChange);
      this.$el.on('click', "." + this.selectors.selectOption + ", ." + this.selectors.arrow, _.bind(this.toggleOptionList, this));
      this.listVisible = false;
      return this.inAnimation = false;
    };

    BaseOptionsView.prototype.render = function() {
      $('<div/>', {
        'class': this.selectors.optionTitle,
        'text': this.title
      }).appendTo(this.$el);
      this.$selectOption = $('<div/>', {
        'class': this.selectors.selectOption
      }).appendTo(this.$el);
      $('<div/>', {
        'class': this.selectors.arrow
      }).appendTo(this.$el);
      this.$optionList = $('<div/>', {
        'class': this.selectors.optionList
      }).appendTo(this.$el);
      this.renderOptionList();
      this.renderOptionSelect();
      return this;
    };

    BaseOptionsView.prototype.renderOptionList = function() {
      return this.collection.each(function(model) {
        var view;
        view = new this.singleOptionView({
          model: model
        });
        return this.$optionList.append(view.render().el);
      }, this);
    };

    BaseOptionsView.prototype.renderOptionSelect = function() {
      var view;
      view = new this.singleOptionView({
        model: this.selectedOption,
        noEvents: true
      });
      return this.$selectOption.html('').append(view.render().el);
    };

    BaseOptionsView.prototype.onChange = function(newOptionModel) {
      this.selectedOption = newOptionModel;
      return this.renderOptionSelect();
    };

    BaseOptionsView.prototype.toggleOptionList = function() {
      this.listVisible = !this.listVisible;
      return this.setClasses();
    };

    BaseOptionsView.prototype.setClasses = function() {
      if (this.listVisible) {
        return this.$el.addClass(this.selectors.visibleClass);
      } else {
        return this.$el.removeClass(this.selectors.visibleClass);
      }
    };

    return BaseOptionsView;

  })(Backbone.View);

  BaseGridView = (function(superClass) {
    extend(BaseGridView, superClass);

    function BaseGridView() {
      return BaseGridView.__super__.constructor.apply(this, arguments);
    }

    BaseGridView.prototype.getGridModel = function() {
      return this.model;
    };

    BaseGridView.prototype.buildArea = function(areaModel) {
      return new AreaOptionView({
        model: areaModel
      });
    };

    BaseGridView.prototype.buildAreaModel = function(area, index) {
      return new Area({
        layoutOptions: area
      });
    };

    BaseGridView.prototype.buildAreas = function() {
      var areas;
      this.$el.html('');
      areas = new AreaList;
      _.each(this.getGridModel().get('areas'), function(area, index) {
        var areaModel, areaView;
        areaModel = this.buildAreaModel(area, index);
        areaView = this.buildArea(areaModel);
        areas.add(areaModel);
        this.$el.append(areaView.render().el);
        return index++;
      }, this);
      return areas;
    };

    return BaseGridView;

  })(Backbone.View);

  GridOption = (function(superClass) {
    extend(GridOption, superClass);

    function GridOption() {
      return GridOption.__super__.constructor.apply(this, arguments);
    }

    GridOption.prototype.defaults = {
      name: 'default',
      areas: []
    };

    return GridOption;

  })(Backbone.Model);

  GridOptionList = (function(superClass) {
    extend(GridOptionList, superClass);

    function GridOptionList() {
      return GridOptionList.__super__.constructor.apply(this, arguments);
    }

    GridOptionList.prototype.model = GridOption;

    return GridOptionList;

  })(Backbone.Collection);

  GridOptionView = (function(superClass) {
    extend(GridOptionView, superClass);

    function GridOptionView() {
      return GridOptionView.__super__.constructor.apply(this, arguments);
    }

    GridOptionView.prototype.className = 'gc-grid-item';

    GridOptionView.prototype.initialize = function(options) {
      if (options.noEvents != null) {
        return this.noEvents = true;
      }
    };

    GridOptionView.prototype.render = function() {
      this.buildAreas();
      return this;
    };

    GridOptionView.prototype.events = {
      click: 'changeGridOption'
    };

    GridOptionView.prototype.changeGridOption = function() {
      if (this.noEvents == null) {
        return eventBus.trigger('gridChange', this.model);
      }
    };

    return GridOptionView;

  })(BaseGridView);

  GridOptionsView = (function(superClass) {
    extend(GridOptionsView, superClass);

    function GridOptionsView() {
      return GridOptionsView.__super__.constructor.apply(this, arguments);
    }

    GridOptionsView.prototype.singleOptionView = GridOptionView;

    GridOptionsView.prototype.optionType = 'grid';

    GridOptionsView.prototype.className = 'gc-options gc-grid-options';

    GridOptionsView.prototype.changeEvent = 'gridChange';

    GridOptionsView.prototype.initialize = function(options) {
      this.title = GRID_CANVAS.strings.selectGrid;
      return GridOptionsView.__super__.initialize.call(this, options);
    };

    return GridOptionsView;

  })(BaseOptionsView);

  Canvas = (function(superClass) {
    extend(Canvas, superClass);

    function Canvas() {
      return Canvas.__super__.constructor.apply(this, arguments);
    }

    Canvas.prototype.defaults = {
      gridOption: null,
      width: 735,
      height: 1102,
      space: 4
    };

    return Canvas;

  })(Backbone.Model);

  CanvasView = (function(superClass) {
    extend(CanvasView, superClass);

    function CanvasView() {
      return CanvasView.__super__.constructor.apply(this, arguments);
    }

    CanvasView.prototype.initialize = function() {
      this.listenTo(eventBus, 'gridChange', this.onGridChange);
      return this.listenTo(eventBus, 'sizeChange', this.onSizeChange);
    };

    CanvasView.prototype.getGridModel = function() {
      return this.model.get('gridOption');
    };

    CanvasView.prototype.buildArea = function(areaModel) {
      return new AreaView({
        model: areaModel
      });
    };

    CanvasView.prototype.buildAreaModel = function(area, index) {
      var image, sel;
      sel = SelectedImages[index];
      image = sel != null ? sel : ImageOptions.at(index);
      return new Area({
        layoutOptions: area,
        image: image,
        parent: this.model,
        index: index
      });
    };

    CanvasView.prototype.render = function() {
      var newAreas;
      this.setSize();
      newAreas = this.buildAreas();
      Areas.reset(newAreas.toArray());
      return this;
    };

    CanvasView.prototype.setSize = function() {
      var height, space, width;
      width = this.model.get('width');
      height = this.model.get('height');
      space = this.model.get('space');
      this.$el.css({
        width: width + space,
        height: height + space,
        top: -space / 2,
        left: -space / 2
      });
      return this.$el.parent().css({
        width: width,
        height: height
      });
    };

    CanvasView.prototype.onGridChange = function(gridOption) {
      this.model.set('gridOption', gridOption);
      return this.render();
    };

    CanvasView.prototype.onSizeChange = function(sizeOption) {
      this.model.set({
        width: parseInt(sizeOption.get('width'), 10),
        height: parseInt(sizeOption.get('height'), 10)
      });
      this.setSize();
      return eventBus.trigger('sizeChanged', sizeOption);
    };

    return CanvasView;

  })(BaseGridView);

  SizeOption = (function(superClass) {
    extend(SizeOption, superClass);

    function SizeOption() {
      return SizeOption.__super__.constructor.apply(this, arguments);
    }

    SizeOption.prototype.defaults = {
      name: 'default',
      width: 0,
      height: 0,
      iconClass: 'none'
    };

    return SizeOption;

  })(Backbone.Model);

  SizeOptionList = (function(superClass) {
    extend(SizeOptionList, superClass);

    function SizeOptionList() {
      return SizeOptionList.__super__.constructor.apply(this, arguments);
    }

    SizeOptionList.prototype.model = SizeOption;

    return SizeOptionList;

  })(Backbone.Collection);

  SizeOptionView = (function(superClass) {
    extend(SizeOptionView, superClass);

    function SizeOptionView() {
      return SizeOptionView.__super__.constructor.apply(this, arguments);
    }

    SizeOptionView.prototype.className = 'gc-size-item';

    SizeOptionView.prototype.defWidth = 50;

    SizeOptionView.prototype.initialize = function(options) {
      this.sizeModel = this.model;
      if (options.noEvents != null) {
        return this.noEvents = true;
      }
    };

    SizeOptionView.prototype.render = function() {
      var h, w;
      w = this.model.get('width');
      h = this.model.get('height');
      this.$el.append($('<div />', {
        'class': 'gc-size-content gc-size-' + this.model.get('iconClass'),
        css: {
          width: this.defWidth,
          height: this.defWidth * h / w
        }
      })).append($('<div />', {
        'class': 'gc-size-preview',
        html: w + " x " + h
      }));
      return this;
    };

    SizeOptionView.prototype.events = {
      click: 'changeSizeOption'
    };

    SizeOptionView.prototype.changeSizeOption = function() {
      if (this.noEvents == null) {
        return eventBus.trigger('sizeChange', this.model);
      }
    };

    return SizeOptionView;

  })(Backbone.View);

  SizeOptionsView = (function(superClass) {
    extend(SizeOptionsView, superClass);

    function SizeOptionsView() {
      return SizeOptionsView.__super__.constructor.apply(this, arguments);
    }

    SizeOptionsView.prototype.singleOptionView = SizeOptionView;

    SizeOptionsView.prototype.optionType = 'size';

    SizeOptionsView.prototype.className = 'gc-options gc-size-options';

    SizeOptionsView.prototype.changeEvent = 'sizeChange';

    SizeOptionsView.prototype.initialize = function(options) {
      this.title = GRID_CANVAS.strings.selectSize;
      return SizeOptionsView.__super__.initialize.call(this, options);
    };

    return SizeOptionsView;

  })(BaseOptionsView);

  Area = (function(superClass) {
    extend(Area, superClass);

    function Area() {
      return Area.__super__.constructor.apply(this, arguments);
    }

    Area.prototype.defaults = {
      layoutOptions: {},
      image: null,
      space: 4,
      imagePosition: {
        x: 50,
        y: 50
      },
      imageSizeId: null,
      parent: null,
      index: 0,
      displayOptions: {},
      el: null
    };

    Area.prototype.hasImage = function() {
      var image;
      image = this.get('image');
      return image && image.get('src');
    };

    Area.prototype.exportData = function() {
      var image, imageData, json, lo;
      lo = this.get('layoutOptions');
      json = {
        layout_options: lo
      };
      if (this.hasImage()) {
        image = this.get('image');
        imageData = {
          id: image.get('id'),
          image_size_id: this.get('imageSizeId'),
          src: image.getSrc(this.get('imageSizeId')),
          position: this.get('imagePosition')
        };
        json.image = imageData;
      }
      return json;
    };

    Area.prototype.getWidth = function() {
      return this.get('parent').get('width') * this.get('layoutOptions').width;
    };

    Area.prototype.getHeight = function() {
      return this.get('parent').get('height') * this.get('layoutOptions').height;
    };

    Area.prototype.getDisplaySize = function() {
      var display_height, display_width, offset, transform;
      transform = AppView.fitter;
      display_width = this.getWidth() * transform.scale;
      display_height = this.getHeight() * transform.scale;
      offset = $(this.get('el')).offset();
      return {
        x_start: offset.left,
        y_start: offset.top,
        x_end: offset.left + display_width,
        y_end: offset.top + display_height
      };
    };

    return Area;

  })(Backbone.Model);

  AreaList = (function(superClass) {
    extend(AreaList, superClass);

    function AreaList() {
      return AreaList.__super__.constructor.apply(this, arguments);
    }

    AreaList.prototype.model = Area;

    AreaList.prototype.exportData = function() {
      var exp;
      exp = [];
      this.forEach(function(area) {
        return exp.push(area.exportData());
      });
      return exp;
    };

    return AreaList;

  })(Backbone.Collection);

  BaseAreaView = (function(superClass) {
    extend(BaseAreaView, superClass);

    function BaseAreaView() {
      return BaseAreaView.__super__.constructor.apply(this, arguments);
    }

    BaseAreaView.prototype.className = 'gc-area';

    BaseAreaView.prototype.hasImgClass = 'gc-has-image';

    BaseAreaView.prototype.renderLayout = function() {
      var css, left, top;
      css = {
        width: (this.model.get('layoutOptions').width * 100) + "%",
        height: (this.model.get('layoutOptions').height * 100) + "%"
      };
      if (left = this.model.get('layoutOptions').left) {
        css.left = (left * 100) + "%";
      }
      if (top = this.model.get('layoutOptions').top) {
        css.top = (top * 100) + "%";
      }
      this.$el.css(css);
      return this;
    };

    return BaseAreaView;

  })(Backbone.View);

  AreaView = (function(superClass) {
    extend(AreaView, superClass);

    function AreaView() {
      return AreaView.__super__.constructor.apply(this, arguments);
    }

    AreaView.prototype.initialize = function() {
      this.listenTo(this.model, 'change:image', this.setImage);
      this.listenTo(this.model, 'change:imagePosition', this.setImagePosition);
      this.listenTo(eventBus, 'sizeChange', this.setImage);
      this.setPositioner();
      return this.setClasses();
    };

    AreaView.prototype.render = function() {
      this.$el.removeAttr('style');
      this.renderLayout();
      this.setImage();
      this.model.set('el', this.el);
      return this;
    };

    AreaView.prototype.setPositioner = function() {
      var positioner;
      positioner = new ImagePositioner({
        parent: this.$el,
        model: this.model
      }).render();
      return this.$el.append(positioner.el);
    };

    AreaView.prototype.getBestImageSize = function() {
      var areaHeight, areaWidth, bestSize, image, sizes;
      areaWidth = this.model.getWidth();
      areaHeight = this.model.getHeight();
      image = this.model.get('image');
      sizes = image.get('sizes');
      bestSize = null;
      if (sizes != null) {
        _.each(sizes, function(img, size) {
          if (img.width >= areaWidth && img.height >= areaHeight) {
            if (((bestSize != null) && img.width < bestSize.width && img.height < bestSize.height) || (bestSize == null)) {
              return bestSize = {
                name: size,
                width: img.width,
                height: img.height
              };
            }
          }
        });
      }
      if (bestSize != null) {
        return bestSize.name;
      } else {
        return null;
      }
    };

    AreaView.prototype.setImage = function() {
      var bestSize, image, index;
      if (this.model.hasImage()) {
        image = this.model.get('image');
        bestSize = this.getBestImageSize();
        this.model.set('imageSizeId', bestSize);
        this.$el.css({
          backgroundImage: "url(" + (image.getSrc(bestSize)) + ")"
        });
        this.setImageCssPosition(50, 50);
        index = this.model.get('index');
        SelectedImages[this.model.get('index')] = image;
      }
      return this.setClasses();
    };

    AreaView.prototype.setImagePosition = function() {
      var image;
      image = this.model.get('image');
      return this.setImageCssPosition(this.model.get('imagePosition').x, this.model.get('imagePosition').y);
    };

    AreaView.prototype.setImageCssPosition = function(x, y) {
      return this.$el.css({
        backgroundPosition: x + "% " + y + "%"
      });
    };

    AreaView.prototype.setClasses = function() {
      if (this.model.hasImage()) {
        return this.$el.addClass(this.hasImgClass);
      } else {
        return this.$el.removeClass(this.hasImgClass);
      }
    };

    return AreaView;

  })(BaseAreaView);

  AreaOptionView = (function(superClass) {
    extend(AreaOptionView, superClass);

    function AreaOptionView() {
      return AreaOptionView.__super__.constructor.apply(this, arguments);
    }

    AreaOptionView.prototype.render = function() {
      this.renderLayout();
      return this;
    };

    return AreaOptionView;

  })(BaseAreaView);

  ImagePositioner = (function(superClass) {
    extend(ImagePositioner, superClass);

    function ImagePositioner() {
      return ImagePositioner.__super__.constructor.apply(this, arguments);
    }

    ImagePositioner.prototype.className = 'gc-position-overlay';

    ImagePositioner.prototype.initialize = function(options) {
      this.listenTo(this.model, 'change:image', this.onImageChange);
      this.$parent = options.parent;
      return this.initDroppable();
    };

    ImagePositioner.prototype.render = function() {
      return this;
    };

    ImagePositioner.prototype.initDroppable = function() {
      this.resetPositions();
      return this.$el.draggable({
        start: _.bind(function(e, ui) {
          var elHeight, elWidth;
          this.lastX = ui.offset.left;
          this.lastY = ui.offset.top;
          if (!!(elWidth = this.$parent.width())) {
            this.ratioX = 100 / elWidth;
          }
          if (!!(elHeight = this.$parent.height())) {
            return this.ratioY = 100 / elHeight;
          }
        }, this),
        drag: _.bind(function(e, ui) {
          var x, y;
          x = ui.offset.left;
          y = ui.offset.top;
          this.posX = this.getNewPosition(x, this.lastX, this.posX, this.ratioX);
          this.posY = this.getNewPosition(y, this.lastY, this.posY, this.ratioY);
          this.lastX = x;
          this.lastY = y;
          return this.model.set('imagePosition', {
            x: this.posX,
            y: this.posY
          });
        }, this),
        stop: _.bind(function(e, ui) {
          return this.$el.css({
            top: 0,
            left: 0
          });
        }, this)
      });
    };

    ImagePositioner.prototype.resetPositions = function() {
      this.lastX = this.lastY = 0;
      this.posX = this.posY = 50;
      return this.ratioX = this.ratioY = 1;
    };

    ImagePositioner.prototype.onImageChange = function() {
      return this.resetPositions();
    };

    ImagePositioner.prototype.getNewPosition = function(p, lastP, posP, ratio) {
      var diffP, newPos;
      diffP = (lastP - p) * ratio;
      newPos = posP + diffP;
      if (newPos > 100) {
        return 100;
      } else if (newPos < 0) {
        return 0;
      } else {
        return parseFloat(newPos.toFixed(2));
      }
    };

    return ImagePositioner;

  })(Backbone.View);

  ImageModel = (function(superClass) {
    extend(ImageModel, superClass);

    function ImageModel() {
      return ImageModel.__super__.constructor.apply(this, arguments);
    }

    ImageModel.prototype.defaults = {
      src: null,
      thumbnail: null,
      sizes: null,
      width: 0,
      height: 0
    };

    ImageModel.prototype.getSrc = function(size) {
      if (size == null) {
        size = null;
      }
      if ((size != null) && (this.get('sizes')[size] != null)) {
        return this.get('sizes')[size].src;
      } else {
        return this.get('src');
      }
    };

    return ImageModel;

  })(Backbone.Model);

  ImageList = (function(superClass) {
    extend(ImageList, superClass);

    function ImageList() {
      return ImageList.__super__.constructor.apply(this, arguments);
    }

    ImageList.prototype.model = ImageModel;

    return ImageList;

  })(Backbone.Collection);

  BaseImageView = (function(superClass) {
    extend(BaseImageView, superClass);

    function BaseImageView() {
      return BaseImageView.__super__.constructor.apply(this, arguments);
    }

    BaseImageView.prototype.className = 'gc-image';

    BaseImageView.prototype.tagName = 'img';

    BaseImageView.prototype.getSrc = function() {
      return this.model.get('src');
    };

    BaseImageView.prototype.render = function() {
      this.$el.attr('src', this.getSrc());
      this.$el.data('modelId', this.model.cid);
      this.setDragEvents();
      return this;
    };

    BaseImageView.prototype.setDragEvents = function() {
      var areas, hoverClass, isInArea, lastHoverArea, self;
      self = this;
      areas = [];
      lastHoverArea = null;
      hoverClass = 'gc-drop-hover';
      isInArea = function(x, y) {
        var currentArea;
        currentArea = _.find(areas, function(area) {
          return x >= area.offset.x_start && x <= area.offset.x_end && y >= area.offset.y_start && y <= area.offset.y_end;
        });
        if (currentArea) {
          return currentArea.model;
        }
      };
      return this.$el.draggable({
        helper: 'clone',
        opacity: 0.5,
        zIndex: 10,
        cursorAt: {
          top: 0,
          left: 0
        },
        start: function() {
          areas = [];
          return _.each(Areas.models, function(area) {
            return areas.push({
              model: area,
              offset: area.getDisplaySize()
            });
          });
        },
        drag: function(e, ui) {
          var $area, area;
          area = isInArea(ui.offset.left, ui.offset.top);
          if (lastHoverArea && (area !== lastHoverArea || !area)) {
            $(lastHoverArea.get('el')).removeClass(hoverClass);
            lastHoverArea = null;
          }
          if (area && area !== lastHoverArea) {
            $area = $(area.get('el'));
            $area.addClass(hoverClass);
            return lastHoverArea = area;
          }
        },
        stop: function(e, ui) {
          var area;
          area = isInArea(ui.offset.left, ui.offset.top);
          if (area) {
            area.set('image', self.model);
          }
          return $('.' + hoverClass).removeClass(hoverClass);
        }
      });
    };

    return BaseImageView;

  })(Backbone.View);

  ImageView = (function(superClass) {
    extend(ImageView, superClass);

    function ImageView() {
      return ImageView.__super__.constructor.apply(this, arguments);
    }

    ImageView.prototype.render = function() {
      ImageView.__super__.render.apply(this, arguments);
      return this;
    };

    return ImageView;

  })(BaseImageView);

  ImageOptionsView = (function(superClass) {
    extend(ImageOptionsView, superClass);

    function ImageOptionsView() {
      return ImageOptionsView.__super__.constructor.apply(this, arguments);
    }

    ImageOptionsView.prototype.selectors = {
      imageList: 'gc-image-list',
      title: 'gc-image-option-title',
      addMore: 'gc-add-images-btn'
    };

    ImageOptionsView.prototype.initialize = function(options) {
      _.bindAll(this, 'doOnAddClick');
      if (options.addCallback) {
        return this.addCallback = options.addCallback;
      }
    };

    ImageOptionsView.prototype.id = 'gc-image-options';

    ImageOptionsView.prototype.render = function() {
      this.imageList = $('<div/>', {
        'class': this.selectors.imageList
      }).appendTo(this.$el);
      if (ImageOptions.length) {
        $('<span />', {
          'class': this.selectors.title,
          text: GRID_CANVAS.strings.dragImages
        }).insertBefore(this.imageList);
        this.addImages(ImageOptions);
      }
      if (this.addCallback != null) {
        $('<div />', {
          'class': this.selectors.addMore
        }).appendTo(this.$el).on('click', this.doOnAddClick);
      }
      return this;
    };

    ImageOptionsView.prototype.addImages = function(images) {
      return images.each(function(image) {
        var view;
        view = new ImageOptionView({
          model: image
        });
        return this.imageList.append(view.render().el);
      }, this);
    };

    ImageOptionsView.prototype.replaceImages = function(images) {
      this.imageList.html('');
      return this.addImages(images);
    };

    ImageOptionsView.prototype.doOnAddClick = function() {
      return this.addCallback().done(_.bind(function(images) {
        if (images.length) {
          ImageOptions.add(images);
          return this.replaceImages(ImageOptions);
        }
      }, this));
    };

    return ImageOptionsView;

  })(Backbone.View);

  ImageOptionView = (function(superClass) {
    extend(ImageOptionView, superClass);

    function ImageOptionView() {
      return ImageOptionView.__super__.constructor.apply(this, arguments);
    }

    ImageOptionView.prototype.getSrc = function() {
      var thumbnail;
      thumbnail = this.model.get('thumbnail');
      return thumbnail || ImageOptionView.__super__.getSrc.apply(this, arguments);
    };

    ImageOptionView.prototype.render = function() {
      ImageOptionView.__super__.render.apply(this, arguments);
      return this;
    };

    return ImageOptionView;

  })(BaseImageView);

  gOptions = [
    {
      name: '2x2 Grid',
      areas: [
        {
          w: '1/2',
          h: '1/2',
          x: '0',
          y: '0'
        }, {
          w: '1/2',
          h: '1/2',
          x: '1/2',
          y: '0'
        }, {
          w: '1/2',
          h: '1/2',
          x: '0',
          y: '1/2'
        }, {
          w: '1/2',
          h: '1/2',
          x: '1/2',
          y: '1/2'
        }
      ]
    }, {
      name: '2x3 Grid',
      areas: [
        {
          w: '1/2',
          h: '1/3',
          x: '0',
          y: '0'
        }, {
          w: '1/2',
          h: '1/3',
          x: '1/2',
          y: '0'
        }, {
          w: '1/2',
          h: '1/3',
          x: '0',
          y: '1/3'
        }, {
          w: '1/2',
          h: '1/3',
          x: '1/2',
          y: '1/3'
        }, {
          w: '1/2',
          h: '1/3',
          x: '0',
          y: '2/3'
        }, {
          w: '1/2',
          h: '1/3',
          x: '1/2',
          y: '2/3'
        }
      ]
    }, {
      name: '3x3 Grid',
      areas: [
        {
          w: '1/3',
          h: '1/3',
          x: '0',
          y: '0'
        }, {
          w: '1/3',
          h: '1/3',
          x: '1/3',
          y: '0'
        }, {
          w: '1/3',
          h: '1/3',
          x: '2/3',
          y: '0'
        }, {
          w: '1/3',
          h: '1/3',
          x: '0',
          y: '1/3'
        }, {
          w: '1/3',
          h: '1/3',
          x: '1/3',
          y: '1/3'
        }, {
          w: '1/3',
          h: '1/3',
          x: '2/3',
          y: '1/3'
        }, {
          w: '1/3',
          h: '1/3',
          x: '0',
          y: '2/3'
        }, {
          w: '1/3',
          h: '1/3',
          x: '1/3',
          y: '2/3'
        }, {
          w: '1/3',
          h: '1/3',
          x: '2/3',
          y: '2/3'
        }
      ]
    }, {
      name: '2 Rows',
      areas: [
        {
          w: '1',
          h: '1/2',
          x: '0',
          y: '0'
        }, {
          w: '1',
          h: '1/2',
          x: '0',
          y: '1/2'
        }
      ]
    }, {
      name: '3 Rows',
      areas: [
        {
          w: '1',
          h: '1/3',
          x: '0',
          y: '0'
        }, {
          w: '1',
          h: '1/3',
          x: '0',
          y: '1/3'
        }, {
          w: '1',
          h: '1/3',
          x: '0',
          y: '2/3'
        }
      ]
    }, {
      name: '4 Rows',
      areas: [
        {
          w: '1',
          h: '1/4',
          x: '0',
          y: '0'
        }, {
          w: '1',
          h: '1/4',
          x: '0',
          y: '1/4'
        }, {
          w: '1',
          h: '1/4',
          x: '0',
          y: '1/2'
        }, {
          w: '1',
          h: '1/4',
          x: '0',
          y: '3/4'
        }
      ]
    }, {
      name: '3 Rows first longer',
      areas: [
        {
          w: '1',
          h: '1/2',
          x: '0',
          y: '0'
        }, {
          w: '1',
          h: '1/4',
          x: '0',
          y: '1/2'
        }, {
          w: '1',
          h: '1/4',
          x: '0',
          y: '3/4'
        }
      ]
    }, {
      name: '2 Columns',
      areas: [
        {
          w: '1/2',
          h: '1',
          x: '0',
          y: '0'
        }, {
          w: '1/2',
          h: '1',
          x: '1/2',
          y: '0'
        }
      ]
    }, {
      name: '3 Columns',
      areas: [
        {
          w: '1/3',
          h: '1',
          x: '0',
          y: '0'
        }, {
          w: '1/3',
          h: '1',
          x: '1/3',
          y: '0'
        }, {
          w: '1/3',
          h: '1',
          x: '2/3',
          y: '0'
        }
      ]
    }, {
      name: '3 Rows and grids',
      areas: [
        {
          w: '1',
          h: '1/3',
          x: '0',
          y: '0'
        }, {
          w: '1/2',
          h: '1/3',
          x: '0',
          y: '1/3'
        }, {
          w: '1/2',
          h: '1/3',
          x: '1/2',
          y: '1/3'
        }, {
          w: '1/2',
          h: '1/3',
          x: '0',
          y: '2/3'
        }, {
          w: '1/2',
          h: '1/3',
          x: '1/2',
          y: '2/3'
        }
      ]
    }, {
      name: '3 Rows and quarter grids',
      areas: [
        {
          w: '1',
          h: '1/2',
          x: '0',
          y: '0'
        }, {
          w: '1/2',
          h: '1/4',
          x: '0',
          y: '1/2'
        }, {
          w: '1/2',
          h: '1/4',
          x: '1/2',
          y: '1/2'
        }, {
          w: '1/2',
          h: '1/4',
          x: '0',
          y: '3/4'
        }, {
          w: '1/2',
          h: '1/4',
          x: '1/2',
          y: '3/4'
        }
      ]
    }, {
      name: '4 Rows in fifth grids',
      areas: [
        {
          w: '1',
          h: '2/5',
          x: '0',
          y: '0'
        }, {
          w: '1/2',
          h: '1/5',
          x: '0',
          y: '2/5'
        }, {
          w: '1/2',
          h: '1/5',
          x: '1/2',
          y: '2/5'
        }, {
          w: '1/2',
          h: '1/5',
          x: '0',
          y: '3/5'
        }, {
          w: '1/2',
          h: '1/5',
          x: '1/2',
          y: '3/5'
        }, {
          w: '1/2',
          h: '1/5',
          x: '0',
          y: '4/5'
        }, {
          w: '1/2',
          h: '1/5',
          x: '1/2',
          y: '4/5'
        }
      ]
    }, {
      name: 'Grid large with 2 smaller',
      areas: [
        {
          w: '1',
          h: '2/3',
          x: '0',
          y: '0'
        }, {
          w: '1/2',
          h: '1/3',
          x: '0',
          y: '2/3'
        }, {
          w: '1/2',
          h: '1/3',
          x: '1/2',
          y: '2/3'
        }
      ]
    }, {
      name: 'Grid large with 3 smaller',
      areas: [
        {
          w: '1',
          h: '2/3',
          x: '0',
          y: '0'
        }, {
          w: '1/3',
          h: '1/3',
          x: '0',
          y: '2/3'
        }, {
          w: '1/3',
          h: '1/3',
          x: '1/3',
          y: '2/3'
        }, {
          w: '1/3',
          h: '1/3',
          x: '2/3',
          y: '2/3'
        }
      ]
    }, {
      name: 'Grid large with 2 smaller',
      areas: [
        {
          w: '1',
          h: '1/2',
          x: '0',
          y: '0'
        }, {
          w: '1/2',
          h: '1/2',
          x: '0',
          y: '1/2'
        }, {
          w: '1/2',
          h: '1/2',
          x: '1/2',
          y: '1/2'
        }
      ]
    }, {
      name: 'Grid 2',
      areas: [
        {
          w: '1/2',
          h: '1/3',
          x: '0',
          y: '0'
        }, {
          w: '1/2',
          h: '2/3',
          x: '1/2',
          y: '0'
        }, {
          w: '1/2',
          h: '1/3',
          x: '0',
          y: '1/3'
        }, {
          w: '1/2',
          h: '1/3',
          x: '0',
          y: '2/3'
        }, {
          w: '1/2',
          h: '1/3',
          x: '1/2',
          y: '2/3'
        }
      ]
    }
  ];

  _.each(gOptions, function(grid) {
    return _.each(grid.areas, function(area) {
      area.width = eval(area.w);
      area.height = eval(area.h);
      area.left = eval(area.x);
      return area.top = eval(area.y);
    });
  });

  GridOptions = new GridOptionList(gOptions);

  SizeOptions = new SizeOptionList([
    {
      name: 'pinterest',
      width: 736,
      height: 1102,
      iconClass: 'pinterest'
    }, {
      name: 'pinterestlong',
      width: 736,
      height: 1500,
      iconClass: 'pinterest'
    }, {
      name: 'twitter',
      width: 1024,
      height: 512,
      iconClass: 'facebook-twitter'
    }, {
      name: 'facebook',
      width: 1200,
      height: 630,
      iconClass: 'facebook'
    }, {
      name: 'instagram',
      width: 1080,
      height: 1080,
      iconClass: 'instagram'
    }
  ]);

  ImageOptions = null;

  SelectedImages = [];

  AppView = null;

  Areas = new AreaList;

  GRID_CANVAS.init = function($el, options) {
    var images;
    images = options.images != null ? options.images : [];
    if (ImageOptions == null) {
      ImageOptions = new ImageList(images);
    }
    GRID_CANVAS.strings = options.strings != null ? options.strings : {};
    options.el = $el;
    AppView = new GridCanvasApp(options);
    return AppView.render();
  };

  GRID_CANVAS["export"] = function() {
    return AppView.exportCanvas();
  };

}).call(this);

//# sourceMappingURL=app.js.map
