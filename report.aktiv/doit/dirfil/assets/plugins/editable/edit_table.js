  $.fn.editable.defaults.mode = 'popup';
  $(document).ready(function() {
    $('.people-editable').editable();
    $('.people-phone-editable').editable({
      type: 'text',
      tpl: '   <input type="text" class="form-control people-phone">'

    }).on('shown', function() {
      $("input.people-phone-editable").mask("(999) 999-9999");
    });
    $('.people-city-editable').editable({
      source: [{
          value: 'Костанай',
          text: 'Костанай'
        },
        {
          value: 'Павлодар',
          text: 'Павлодар'
        },
        {
          value: 'Астана',
          text: 'Астана'
        },
        {
          value: 'Алматы',
          text: 'Алматы'
        },{
          value: 'Уральск',
          text: 'Уральск'
        },{
          value: 'Тараз',
          text: 'Тараз'
        },{
          value: 'Тараз',
          text: 'Тараз'
        },{
          value: 'Тараз',
          text: 'Тараз'
        },{
          value: 'Атырау',
          text: 'Атырау'
        },{
          value: 'Актау',
          text: 'Актау'
        },{
          value: 'Караганда',
          text: 'Караганда'
        },{
          value: 'Семей',
          text: 'Семей'
        },{
          value: 'Талдыкорган',
          text: 'Талдыкорган'
        }
      ]
    });
    $('.people-date-editable').editable({
      format: 'dd.mm.yyyy',
      viewformat: 'dd.mm.yyyy',
      datepicker: {
        weekStart: 1
      }
    });
    $('.people-status-editable').editable({
      value: 'Активный',
      source: [{
          value: 'Активный',
          text: 'Активный'
        },
        {
          value: 'Заблокирован',
          text: 'Заблокирован'
        },
        {
          value: 'Устарел',
          text: 'Устарел'
        }
      ]
    });
    $('.people-email-editable').editable({
      validate: function(value) {
        if (isEmail(value)) {

        } else {
          return 'Введите настоящий e-mail';
        }
      }
    });

    $('.people-address-editable').editable({
      value: {}
    });
  });

  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }