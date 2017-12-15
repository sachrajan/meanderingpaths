(function() {
  var $, AccountQuery, AccountStatus, AccountStatusView, FormQuery, FormView, GridCanvasSettings, GridCanvasSettingsView, Query, RegistrationFormView, SignInFormView, eventBus, getOption, getString,
    extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    hasProp = {}.hasOwnProperty;

  Query = (function() {
    function Query() {}

    Query.getResponseError = function(res) {
      if (res.responseJSON && res.responseJSON.error) {
        return res.responseJSON.error;
      } else {
        return (getString('ajaxError')) + ": " + res.statusText;
      }
    };

    return Query;

  })();

  FormQuery = (function(superClass) {
    extend(FormQuery, superClass);

    function FormQuery() {
      return FormQuery.__super__.constructor.apply(this, arguments);
    }

    FormQuery.sendAccountAction = function(formData, action) {
      var data;
      data = _.extend({
        action: action,
        nonce: getOption('nonce')
      }, formData);
      return $.ajax({
        method: 'post',
        data: data,
        url: ajaxurl,
        dataType: 'json'
      });
    };

    return FormQuery;

  })(Query);

  FormView = (function(superClass) {
    extend(FormView, superClass);

    function FormView() {
      return FormView.__super__.constructor.apply(this, arguments);
    }

    FormView.prototype.strings = {};

    FormView.prototype.successEvent = 'submitSuccess';

    FormView.prototype.fieldTemplate = '<div class="gc-form-field"> <label><%= label %></label> <input type="<%= type %>" name="<%= name %>" id="gc-field-<%= name %>" required /> </div>';

    FormView.prototype.formTemplate = '<div class="gc-form-header-wrapper"> <h2><%= title %></h2> <p><%= subtitle %></p> </div> <form autocomplete="off" class="gc-account-form"> <input type="password" class="gc-password-hidden" /> <input type="submit" class="gc-submit" value="<%= submit %>" /> <div class="gc-loading"></div> </form>';

    FormView.prototype.initialize = function() {
      _.bindAll(this, 'renderField', 'submit');
      this.fieldTemplate = _.template(this.fieldTemplate);
      return this.formTemplate = _.template(this.formTemplate);
    };

    FormView.prototype.render = function() {
      this.$el.append(this.formTemplate(this.strings));
      this.$form = this.$el.find('form').eq(0).submit(this.submit);
      this.$submit = this.$form.find('input[type="submit"]').eq(0);
      this.$loading = this.$form.find('.gc-loading');
      _.each(this.fields, this.renderField);
      return this;
    };

    FormView.prototype.renderField = function(field) {
      var $field;
      $field = $(this.fieldTemplate(field));
      if (field.after) {
        $field.append(field.after);
      }
      return $field.insertBefore(this.$submit);
    };

    FormView.prototype.submit = function(e) {
      var data;
      e.preventDefault();
      this.removeError();
      this.showLoading();
      data = this.getFormData();
      return FormQuery.sendAccountAction(data, this.ajaxAction).done(_.bind((function(res) {
        return eventBus.trigger(this.successEvent, res);
      }), this)).fail(_.bind((function(res) {
        return this.showError(FormQuery.getResponseError(res));
      }), this)).always(_.bind((function() {
        return this.hideLoading();
      }), this));
    };

    FormView.prototype.getFormData = function() {
      var data;
      data = {};
      _.each(this.$form.serializeArray(), function(item) {
        return data[item.name] = item.value;
      });
      return data;
    };

    FormView.prototype.showError = function(message) {
      this.removeError();
      return this.$error = $('<div/>', {
        'class': 'gc-error',
        text: message
      }).insertBefore(this.$form);
    };

    FormView.prototype.removeError = function() {
      if (this.$error != null) {
        this.$error.remove();
        return this.$error = null;
      }
    };

    FormView.prototype.showLoading = function() {
      return this.$loading.show();
    };

    FormView.prototype.hideLoading = function() {
      return this.$loading.hide();
    };

    return FormView;

  })(Backbone.View);

  RegistrationFormView = (function(superClass) {
    extend(RegistrationFormView, superClass);

    function RegistrationFormView() {
      return RegistrationFormView.__super__.constructor.apply(this, arguments);
    }

    RegistrationFormView.prototype.ajaxAction = 'gc_register';

    RegistrationFormView.prototype.className = 'gc-form gc-registration-form';

    RegistrationFormView.prototype.successEvent = 'registerSuccess';

    RegistrationFormView.prototype.initialize = function() {
      RegistrationFormView.__super__.initialize.call(this);
      this.fields = [
        {
          name: 'name',
          type: 'text',
          label: getString('name')
        }, {
          name: 'email',
          type: 'email',
          label: getString('email')
        }, {
          name: 'password',
          type: 'password',
          label: getString('password')
        }
      ];
      return this.strings = {
        title: getString('register'),
        subtitle: getString('register_subtitle'),
        submit: getString('start_trial')
      };
    };

    return RegistrationFormView;

  })(FormView);

  SignInFormView = (function(superClass) {
    extend(SignInFormView, superClass);

    function SignInFormView() {
      return SignInFormView.__super__.constructor.apply(this, arguments);
    }

    SignInFormView.prototype.ajaxAction = 'gc_signin';

    SignInFormView.prototype.className = 'gc-form gc-sign-in-form';

    SignInFormView.prototype.successEvent = 'signInSuccess';

    SignInFormView.prototype.initialize = function() {
      SignInFormView.__super__.initialize.call(this);
      this.fields = [
        {
          name: 'email',
          type: 'email',
          label: getString('email')
        }, {
          name: 'password',
          type: 'password',
          label: getString('password'),
          after: '<a href="' + getOption('password_reset_link') + '" target="_blank">' + getString('forgot_password') + '</a>'
        }
      ];
      return this.strings = {
        title: getString('sign_in'),
        subtitle: getString('sign_in_subtitle'),
        submit: getString('sign_in')
      };
    };

    return SignInFormView;

  })(FormView);

  AccountStatus = (function(superClass) {
    extend(AccountStatus, superClass);

    function AccountStatus() {
      return AccountStatus.__super__.constructor.apply(this, arguments);
    }

    AccountStatus.prototype.defaults = {
      email: null,
      generations: null,
      subscription: null,
      token: null,
      info: []
    };

    return AccountStatus;

  })(Backbone.Model);

  AccountQuery = (function(superClass) {
    extend(AccountQuery, superClass);

    function AccountQuery() {
      return AccountQuery.__super__.constructor.apply(this, arguments);
    }

    AccountQuery.refreshStatus = function() {
      var data;
      data = _.extend({
        action: 'gc_refresh_account',
        nonce: getOption('nonce')
      });
      return $.ajax({
        method: 'post',
        data: data,
        url: ajaxurl,
        dataType: 'json'
      });
    };

    AccountQuery.getManageAccountLink = function() {
      var data;
      data = _.extend({
        action: 'gc_get_manage_account_link',
        nonce: getOption('nonce')
      });
      return $.ajax({
        method: 'post',
        data: data,
        url: ajaxurl,
        dataType: 'json'
      });
    };

    return AccountQuery;

  })(Query);

  AccountStatusView = (function(superClass) {
    extend(AccountStatusView, superClass);

    function AccountStatusView() {
      return AccountStatusView.__super__.constructor.apply(this, arguments);
    }

    AccountStatusView.prototype.className = 'gc-account-status';

    AccountStatusView.prototype.fieldTemplate = '<tr><td class="gc-status-label"><%= label %>:</td> <td class="gc-status-value"><%= value %></td></tr>';

    AccountStatusView.prototype.isLoading = false;

    AccountStatusView.prototype.initialize = function() {
      _.bindAll(this, 'refreshStatus', 'hideLoading', 'getManageAcccountLink');
      return this.fieldTemplate = _.template(this.fieldTemplate);
    };

    AccountStatusView.prototype.render = function() {
      this.$title = $('<h2 />', {
        text: getString('your_account')
      }).appendTo(this.$el);
      this.$fieldsTable = $('<table />', {
        'class': 'gc-account-fields'
      }).appendTo(this.$el);
      this.renderFields();
      if (getOption('show_manage_account_button')) {
        this.$el.append($('<button />', {
          text: getString('manage_account'),
          'class': 'gc-button gc-manage-account'
        }).on('click', this.getManageAcccountLink));
      }
      this.$el.append($('<button />', {
        text: getString('refresh'),
        'class': 'gc-button gc-refresh'
      }).on('click', this.refreshStatus));
      this.$loading = $('<div />', {
        'class': 'gc-loading'
      }).appendTo(this.$el);
      return this;
    };

    AccountStatusView.prototype.renderFields = function() {
      var info;
      this.$fieldsTable.html('');
      info = this.model.get('info');
      if (info.length > 0) {
        _.each(info, function(info_el) {
          return this.$fieldsTable.append(this.fieldTemplate({
            label: info_el.label,
            value: info_el.value
          }));
        }, this);
        return this;
      }
    };

    AccountStatusView.prototype.refreshStatus = function() {
      this.showLoading();
      return AccountQuery.refreshStatus().done(_.bind((function(res) {
        this.model.set(res);
        return this.renderFields();
      }), this)).fail(_.bind((function(res) {
        return this.showErrorMessage(AccountQuery.getResponseError(res));
      }), this)).always(this.hideLoading);
    };

    AccountStatusView.prototype.getManageAcccountLink = function() {
      if (this.isLoading) {
        return;
      }
      this.showLoading();
      return AccountQuery.getManageAccountLink().done(_.bind((function(res) {
        var link;
        link = res && res.link ? res.link : getOption('manage_account_link_fallback');
        return this.openManageAccount(link);
      }), this)).fail(_.bind((function(res) {
        return this.openManageAccount(getOption('manage_account_link_fallback'));
      }), this)).always(this.hideLoading);
    };

    AccountStatusView.prototype.openManageAccount = function(link) {
      return window.location.href = link;
    };

    AccountStatusView.prototype.showInfoMessage = function(message) {
      return $('<div />', {
        'class': 'gc-info-message',
        html: message
      }).insertAfter(this.$title);
    };

    AccountStatusView.prototype.showErrorMessage = function(message) {
      this.$el.find('.gc-error').remove();
      return $('<div />', {
        'class': 'gc-error',
        text: message
      }).insertAfter(this.$title);
    };

    AccountStatusView.prototype.showLoading = function() {
      this.$loading.show();
      return this.isLoading = true;
    };

    AccountStatusView.prototype.hideLoading = function() {
      this.$loading.hide();
      return this.isLoading = false;
    };

    return AccountStatusView;

  })(Backbone.View);

  window.GC_SETTINGS || (window.GC_SETTINGS = {});

  $ = jQuery;

  eventBus = _({}).extend(Backbone.Events);

  getOption = function(key) {
    return GC_SETTINGS.options[key];
  };

  getString = function(key) {
    return GC_SETTINGS.strings[key] || "";
  };

  GridCanvasSettings = (function(superClass) {
    extend(GridCanvasSettings, superClass);

    function GridCanvasSettings() {
      return GridCanvasSettings.__super__.constructor.apply(this, arguments);
    }

    GridCanvasSettings.prototype.defaults = {
      account: null
    };

    GridCanvasSettings.prototype.hasAccount = function() {
      var account;
      account = this.get('account');
      return (account != null) && (account.get('email') != null);
    };

    return GridCanvasSettings;

  })(Backbone.Model);

  GridCanvasSettingsView = (function(superClass) {
    extend(GridCanvasSettingsView, superClass);

    function GridCanvasSettingsView() {
      return GridCanvasSettingsView.__super__.constructor.apply(this, arguments);
    }

    GridCanvasSettingsView.prototype.initialize = function() {
      _.bindAll(this, 'onRegisterSuccess', 'onSignInSuccess');
      this.listenTo(eventBus, 'registerSuccess', this.onRegisterSuccess);
      return this.listenTo(eventBus, 'signInSuccess', this.onSignInSuccess);
    };

    GridCanvasSettingsView.prototype.render = function() {
      if (this.model.hasAccount()) {
        return this.buildAccountStatus();
      } else {
        this.buildForm();
        return this.switchToForm('register');
      }
    };

    GridCanvasSettingsView.prototype.buildForm = function() {
      this.$formWrap = $('<div />', {
        'class': 'gc-form-wrap'
      }).appendTo(this.$el);
      this.reg = {};
      this.signIn = {};
      this.reg.$form = $(new RegistrationFormView().render().el);
      this.signIn.$form = $(new SignInFormView().render().el);
      this.$formWrap.append(this.reg.$form);
      this.$formWrap.append(this.signIn.$form);
      this.signIn.$switcher = this.createSwitcher('register', getString('not_have_account'), getString('register'));
      return this.reg.$switcher = this.createSwitcher('sign_in', getString('have_account'), getString('sign_in'));
    };

    GridCanvasSettingsView.prototype.createSwitcher = function(type, text, linkText) {
      var $switcher;
      $switcher = $('<p />', {
        'class': 'gc-form-switch-text',
        text: text
      }).appendTo(this.$formWrap);
      $switcher.append($('<a />', {
        href: '#',
        text: linkText
      }).on('click', _.bind((function(e) {
        e.preventDefault();
        return this.switchToForm(type);
      }), this)));
      return $switcher;
    };

    GridCanvasSettingsView.prototype.buildAccountStatus = function() {
      var el;
      this.$statusView = new AccountStatusView({
        model: this.model.get('account')
      });
      el = this.$statusView.render().el;
      $(el).append($('<a />', {
        href: '#',
        text: getString('use_another_account'),
        "class": "gc-use-another-account"
      }).on('click', _.bind((function(e) {
        e.preventDefault();
        return this.switchFromStatusToSignIn();
      }), this)));
      return this.$el.append(el);
    };

    GridCanvasSettingsView.prototype.switchFromStatusToSignIn = function() {
      this.buildForm();
      this.$statusView.$el.hide();
      this.switchToForm('sign_in');
      return this.signIn.$switcher.hide();
    };

    GridCanvasSettingsView.prototype.switchToForm = function(formName) {
      var toHide, toShow;
      if (formName === 'register') {
        toShow = this.reg;
        toHide = this.signIn;
      } else {
        toShow = this.signIn;
        toHide = this.reg;
      }
      toShow.$form.show();
      toShow.$switcher.show();
      toHide.$form.hide();
      return toHide.$switcher.hide();
    };

    GridCanvasSettingsView.prototype.onRegisterSuccess = function(data) {
      return this.switchToAccountStatus(data, getString('register_success'));
    };

    GridCanvasSettingsView.prototype.onSignInSuccess = function(data) {
      return this.switchToAccountStatus(data, getString('sign_in_success'));
    };

    GridCanvasSettingsView.prototype.switchToAccountStatus = function(accountData, message) {
      var accountStatus;
      accountStatus = new AccountStatus(accountData);
      this.model.set('account', accountStatus);
      this.$formWrap.remove();
      this.buildAccountStatus();
      return this.$statusView.showInfoMessage(message);
    };

    return GridCanvasSettingsView;

  })(Backbone.View);

  $(function() {
    var accountStatus, settings, settingsView;
    accountStatus = new AccountStatus(getOption('account'));
    settings = new GridCanvasSettings({
      account: accountStatus
    });
    settingsView = new GridCanvasSettingsView({
      el: $('#gc-settings-wrapper'),
      model: settings
    });
    return settingsView.render();
  });

}).call(this);

//# sourceMappingURL=grid-canvas-settings.js.map
