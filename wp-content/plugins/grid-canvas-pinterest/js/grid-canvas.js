(function() {
  var $, GeneratedImage, GeneratedImageList, GeneratedImageView, GridCanvasWP, Modal, ModalStatus, ModalStatusView, Query, ShareButton, ShareButtonBuilder, ShareButtonView, getString, modalEvents,
    extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    hasProp = {}.hasOwnProperty;

  modalEvents = _({}).extend(Backbone.Events);

  Modal = (function(superClass) {
    extend(Modal, superClass);

    function Modal() {
      return Modal.__super__.constructor.apply(this, arguments);
    }

    Modal.prototype.className = 'gc-modal';

    Modal.prototype.selectors = {
      modalOpen: 'gc-modal-open'
    };

    Modal.isOpen = false;

    Modal.prototype.title = '';

    Modal.prototype.initialize = function(options) {
      this.listenTo(modalEvents, 'removeStatus', this.removeStatus);
      _.bindAll(this, 'removeStatus');
      if (options.title != null) {
        this.title = options.title;
      }
      return this;
    };

    Modal.prototype.render = function($child) {
      if (Modal.isOpen) {
        return false;
      }
      this.$el.appendTo($('body'));
      this.$content = $('<div/>', {
        'class': 'gc-modal-content'
      }).appendTo(this.$el);
      this.$header = $('<div/>', {
        'class': 'gc-modal-header',
        'html': this.title
      }).appendTo(this.$content);
      $('<div/>', {
        'class': 'gc-close'
      }).appendTo(this.$header);
      this.$content.append($child);
      this.setOpenState(true);
      return this;
    };

    Modal.prototype.events = {
      'click .gc-close': 'close'
    };

    Modal.prototype.setOpenState = function(open) {
      if (open) {
        $('body').addClass(this.selectors.modalOpen);
      } else {
        $('body').removeClass(this.selectors.modalOpen);
      }
      return Modal.isOpen = open;
    };

    Modal.prototype.setStatus = function(status) {
      if (this.statusView == null) {
        this.statusView = new ModalStatusView({
          model: status
        });
        return this.$content.append(this.statusView.render().el);
      }
    };

    Modal.prototype.removeStatus = function() {
      if (this.statusView != null) {
        this.statusView.remove();
        return this.statusView = null;
      }
    };

    Modal.prototype.close = function() {
      this.setOpenState(false);
      return this.remove();
    };

    return Modal;

  })(Backbone.View);

  ModalStatus = (function(superClass) {
    extend(ModalStatus, superClass);

    function ModalStatus() {
      return ModalStatus.__super__.constructor.apply(this, arguments);
    }

    ModalStatus.prototype.defaults = {
      message: null,
      error: null,
      loading: false
    };

    return ModalStatus;

  })(Backbone.Model);

  ModalStatusView = (function(superClass) {
    extend(ModalStatusView, superClass);

    function ModalStatusView() {
      return ModalStatusView.__super__.constructor.apply(this, arguments);
    }

    ModalStatusView.prototype.className = 'gc-modal-overlay';

    ModalStatusView.prototype.selectors = {
      loading: 'gc-modal-loading',
      message: 'gc-modal-message',
      error: 'gc-modal-error',
      status: 'gc-overlay-status',
      close: 'gc-overlay-close'
    };

    ModalStatusView.prototype.initialize = function() {
      _.bindAll(this, 'close');
      this.listenTo(this.model, 'change:loading', this.setLoading);
      this.listenTo(this.model, 'change:message', this.setMessage);
      return this.listenTo(this.model, 'change:error', this.setError);
    };

    ModalStatusView.prototype.render = function() {
      this.setLoading();
      this.setMessage();
      this.setError();
      return this;
    };

    ModalStatusView.prototype.setLoading = function() {
      if (this.model.get('loading')) {
        return this.$el.addClass(this.selectors.loading);
      } else {
        return this.$el.removeClass(this.selectors.loading);
      }
    };

    ModalStatusView.prototype.setMessage = function() {
      return this.$message = this.setStatus(this.$message, 'message');
    };

    ModalStatusView.prototype.setError = function() {
      return this.$error = this.setStatus(this.$error, 'error');
    };

    ModalStatusView.prototype.setStatus = function($statusEl, type) {
      var status;
      status = this.model.get(type);
      if ($statusEl != null) {
        $statusEl.remove();
        $statusEl = null;
      }
      if (status != null) {
        $statusEl = $('<div />', {
          'class': this.selectors.status + " " + this.selectors[type],
          'html': "<p>" + status + "</p>"
        }).appendTo(this.$el);
        if (type === 'error') {
          $('<div />', {
            'class': this.selectors.close
          }).appendTo($statusEl).on('click', this.close);
        }
      }
      return $statusEl;
    };

    ModalStatusView.prototype.close = function() {
      return modalEvents.trigger('removeStatus');
    };

    return ModalStatusView;

  })(Backbone.View);

  ShareButtonBuilder = (function() {
    function ShareButtonBuilder() {}

    ShareButtonBuilder.build = function(type, image) {
      return new ShareButton({
        url: image.get('share_link'),
        type: type,
        image: image.get('url'),
        title: GC_WP.options.postTitle
      });
    };

    return ShareButtonBuilder;

  })();

  ShareButton = (function(superClass) {
    extend(ShareButton, superClass);

    function ShareButton() {
      return ShareButton.__super__.constructor.apply(this, arguments);
    }

    ShareButton.prototype.defaults = {
      url: null,
      type: null,
      title: null,
      image: null
    };

    return ShareButton;

  })(Backbone.Model);

  ShareButtonView = (function(superClass) {
    extend(ShareButtonView, superClass);

    function ShareButtonView() {
      return ShareButtonView.__super__.constructor.apply(this, arguments);
    }

    ShareButtonView.prototype.render = function() {
      this.initShare();
      return this;
    };

    ShareButtonView.prototype.initShare = function() {
      var args, type;
      type = this.model.get('type');
      args = {
        url: this.model.get('url'),
        text: this.model.get('title'),
        share: {},
        template: '<span class="gc-share-icon"></span><span>' + getString('share') + '</span>',
        enableHover: false,
        enableTracking: false,
        urlCurl: '',
        buttons: {},
        className: "gc-share-btn gc-share-" + type,
        click: function(api, options) {
          api.simulateClick();
          return api.openPopup(type);
        }
      };
      if (type === 'pinterest') {
        args.buttons.pinterest = {
          media: this.model.get('image'),
          description: this.model.get('title')
        };
      }
      args.share[this.model.get('type')] = true;
      return this.$el.sharrre(args);
    };

    return ShareButtonView;

  })(Backbone.View);

  GeneratedImage = (function(superClass) {
    extend(GeneratedImage, superClass);

    function GeneratedImage() {
      return GeneratedImage.__super__.constructor.apply(this, arguments);
    }

    GeneratedImage.prototype.defaults = {
      'url': null,
      'share_link': null
    };

    return GeneratedImage;

  })(Backbone.Model);

  GeneratedImageList = (function(superClass) {
    extend(GeneratedImageList, superClass);

    function GeneratedImageList() {
      return GeneratedImageList.__super__.constructor.apply(this, arguments);
    }

    GeneratedImageList.prototype.model = GeneratedImage;

    return GeneratedImageList;

  })(Backbone.Collection);

  GeneratedImageView = (function(superClass) {
    extend(GeneratedImageView, superClass);

    function GeneratedImageView() {
      return GeneratedImageView.__super__.constructor.apply(this, arguments);
    }

    GeneratedImageView.prototype.className = 'gc-generated-image';

    GeneratedImageView.prototype.render = function() {
      this.$el.append($('<img />', {
        src: this.model.get('url')
      }));
      this.$overlay = $('<div />', {
        'class': 'gc-image-overlay'
      }).appendTo(this.$el);
      this.renderShare();
      this.renderDownload();
      return this;
    };

    GeneratedImageView.prototype.renderShare = function() {
      var $share_wrap, btnModel;
      $share_wrap = $('<div />', {
        'class': 'gc-share-wrap'
      }).appendTo(this.$overlay);
      btnModel = ShareButtonBuilder.build('pinterest', this.model);
      return $share_wrap.append(new ShareButtonView({
        model: btnModel
      }).render().el);
    };

    GeneratedImageView.prototype.renderDownload = function() {
      return $('<a />', {
        text: getString('download'),
        href: this.model.get('url'),
        download: '',
        target: '_blank',
        'class': 'gc-download'
      }).appendTo(this.$overlay);
    };

    return GeneratedImageView;

  })(Backbone.View);

  window.GC_WP || (window.GC_WP = {});

  $ = jQuery;

  Query = (function() {
    function Query() {}

    Query.getPostImages = function() {
      var data;
      data = {
        post_id: GC_WP.options.postId,
        action: 'gc_get_post_images',
        nonce: GC_WP.options.nonce
      };
      return $.ajax({
        method: 'get',
        data: data,
        url: ajaxurl,
        dataType: 'json'
      });
    };

    Query.getImageData = function(imageIds) {
      var data;
      data = {
        image_ids: imageIds,
        action: 'gc_get_image_data',
        nonce: GC_WP.options.nonce
      };
      return $.ajax({
        method: 'get',
        data: data,
        url: ajaxurl,
        dataType: 'json'
      });
    };

    Query.generateImage = function(exportData) {
      var data;
      data = {
        post_id: GC_WP.options.postId,
        action: 'gc_generate_image',
        nonce: GC_WP.options.nonce,
        data: exportData
      };
      return $.ajax({
        method: 'post',
        data: data,
        url: ajaxurl,
        dataType: 'json'
      });
    };

    Query.getResponseError = function(res) {
      if (res.responseJSON && res.responseJSON.error) {
        return res.responseJSON.error;
      } else {
        return (getString('ajaxError')) + ": " + res.statusText;
      }
    };

    return Query;

  })();

  getString = function(key) {
    return GC_WP.strings[key];
  };

  GridCanvasWP = (function(superClass) {
    extend(GridCanvasWP, superClass);

    function GridCanvasWP() {
      return GridCanvasWP.__super__.constructor.apply(this, arguments);
    }

    GridCanvasWP.prototype.images = [];

    GridCanvasWP.prototype.imagesLoaded = false;

    GridCanvasWP.prototype.initialize = function() {
      _.bindAll(this, 'generateImage', 'onCreateClicked', 'addImages');
      return this.generatedImages = new GeneratedImageList(GC_WP.options.generatedImages);
    };

    GridCanvasWP.prototype.render = function() {
      this.createBtn = $('<div/>', {
        'class': 'gc-create',
        'html': '<div class="gc-create-plus"></div><span class="gc-reate-text">' + getString('createImage') + '</span>'
      }).appendTo(this.$el);
      return _.each(this.generatedImages.models, function(image, index) {
        return this.addGeneratedImage(image);
      }, this);
    };

    GridCanvasWP.prototype.events = {
      'click .gc-create': 'onCreateClicked'
    };


    /**
    	 * Makes a request to generate the image from the canvas settings
     */

    GridCanvasWP.prototype.generateImage = function() {
      var data, status;
      data = GRID_CANVAS["export"]();
      status = new ModalStatus({
        loading: true,
        message: getString('generatingImage')
      });
      this.modal.setStatus(status);
      return Query.generateImage(data).done(_.bind(function(res) {
        var image;
        image = new GeneratedImage(res);
        this.addGeneratedImage(image);
        return this.modal.close();
      }, this)).fail(_.bind(function(res) {
        return status.set({
          error: Query.getResponseError(res),
          loading: false,
          message: null
        });
      }, this));
    };


    /**
    	 * Once the image has been generated successfully, adds the image to the
    	 * generated images list
     */

    GridCanvasWP.prototype.addGeneratedImage = function(image) {
      return this.$el.append(new GeneratedImageView({
        model: image
      }).render().el);
    };


    /**
    	 * Opens the WordPress media window to allow add more images to the available
    	 * image set.
    	 * @return {object} A promise that is resolved when the image data has been loaded
     */

    GridCanvasWP.prototype.addImages = function() {
      var def;
      def = $.Deferred();
      this.media = wp.media({
        title: getString('selectImages'),
        button: {
          text: getString('add')
        },
        library: {
          type: 'image'
        },
        multiple: true
      });
      this.media.on('select', _.bind(function() {
        var ids, selection, status;
        selection = this.media.state().get('selection');
        ids = selection.pluck('id');
        status = new ModalStatus({
          loading: true,
          message: getString('loadingImageData')
        });
        this.modal.setStatus(status);
        return Query.getImageData(ids).done(_.bind(function(res) {
          def.resolve(res);
          return this.modal.removeStatus();
        }, this)).fail(_.bind(function(res) {
          return status.set({
            error: Query.getResponseError(res),
            loading: false,
            message: null
          });
        }, this));
      }, this));
      this.media.open();
      return def.promise();
    };


    /**
    	 * Opens a modal and initializes the main app in the modal
     */

    GridCanvasWP.prototype.onCreateClicked = function() {
      var $app, status;
      if (!Modal.isOpen) {
        $app = $('<div />', {
          'id': 'gc-app'
        });
        this.modal = new Modal({
          title: '<span class="gc-modal-logo"></span>'
        }).render($app);
        if (this.imagesLoaded) {
          return this.initApp($app, this.images);
        } else {
          status = new ModalStatus({
            loading: true,
            message: getString('loadingImages')
          });
          this.modal.setStatus(status);
          return Query.getPostImages().done(_.bind(function(res) {
            if (res && !res.error && res instanceof Array) {
              return this.images = res;
            }
          }, this)).always(_.bind(function() {
            this.imagesLoaded = true;
            this.initApp($app, this.images);
            return this.modal.removeStatus();
          }, this));
        }
      }
    };

    GridCanvasWP.prototype.initApp = function($app, images) {
      var options;
      options = {
        images: images,
        strings: GC_WP.strings,
        generateCallback: this.generateImage,
        addImagesCallback: this.addImages
      };
      return GRID_CANVAS.init($app, options);
    };

    return GridCanvasWP;

  })(Backbone.View);

  $(function() {
    var wpView;
    wpView = new GridCanvasWP({
      el: $('#gc-wrapper')
    });
    return wpView.render();
  });

}).call(this);

//# sourceMappingURL=grid-canvas.js.map
