     
     document.oncontextmenu = cmenu;
      debugger;
        function cmenu() {
          return false;
        }

        function preventSelection(element) {
          var preventSelection = false;

          function addHandler(element, event, handler) {
            if (element.attachEvent) element.attachEvent('on' + event, handler);
            else if (element.addEventListener) element.addEventListener(event, handler, false);
          }

          function removeSelection() {
            if (window.getSelection) {
              window.getSelection().removeAllRanges();
            } else if (document.selection && document.selection.clear)
              document.selection.clear();
          }
          addHandler(element, 'mousemove', function() {
            if (preventSelection) removeSelection();
          });
          addHandler(element, 'mousedown', function(event) {
            var event = event || window.event;
            var sender = event.target || event.srcElement;
            preventSelection = !sender.tagName.match(/INPUT|TEXTAREA/i);
          });

          function killCtrlA(event) {
            var event = event || window.event;
            var sender = event.target || event.srcElement;
            if (sender.tagName.match(/INPUT|TEXTAREA/i)) return;
            var key = event.keyCode || event.which;
            if ((key == 123) || (event.ctrlKey && key == 'U'.charCodeAt(0)) || (event.ctrlKey && key == 'A'.charCodeAt(0)) || (event.ctrlKey && key == 'S'.charCodeAt(0)) || (event.ctrlKey && key == 'P'.charCodeAt(0)) ||(event.ctrlKey  && event.shiftKey && key == 'I'.charCodeAt(0)) || (event.ctrlKey  && event.shiftKey && key == 'i'.charCodeAt(0))) // 'A'.charCodeAt(0) ����� �������� �� 65
            {
              removeSelection();
              if (event.preventDefault) event.preventDefault();
              else event.returnValue = false;
            }
          }
          addHandler(element, 'keydown', killCtrlA);
          addHandler(element, 'keyup', killCtrlA);
        }
        preventSelection(document);


    function debuggerOpened() {
        console.log('debugger opened')
    }

    let last = Date.now()
    setInterval(function () {
        debugger;
        let now = Date.now()
        now - last > 500 && debuggerOpened();
        last = now;
    }, 10)


