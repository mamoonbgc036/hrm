{{-- <script>
    $(document).ready(function() {
        $(document).bind("contextmenu", function(e) {
            return false;
        });
    })

    console.log('test if console disabled');

    (function() {
        'use strict';

        const devtools = {
            isOpen: false,
            orientation: undefined
        };

        const threshold = 160;

        const emitEvent = (isOpen, orientation) => {
            window.dispatchEvent(new CustomEvent('devtoolschange', {
                detail: {
                    isOpen,
                    orientation
                }
            }));
        };

        const main = ({
            emitEvents = true
        } = {}) => {
            const widthThreshold = window.outerWidth - window.innerWidth > threshold;
            const heightThreshold = window.outerHeight - window.innerHeight > threshold;
            const orientation = widthThreshold ? 'vertical' : 'horizontal';

            if (
                !(heightThreshold && widthThreshold) &&
                ((window.Firebug && window.Firebug.chrome && window.Firebug.chrome.isInitialized) ||
                    widthThreshold || heightThreshold)
            ) {
                if ((!devtools.isOpen || devtools.orientation !== orientation) && emitEvents) {
                    emitEvent(true, orientation);
                }

                devtools.isOpen = true;
                devtools.orientation = orientation;
            } else {
                if (devtools.isOpen && emitEvents) {
                    emitEvent(false, undefined);
                }

                devtools.isOpen = false;
                devtools.orientation = undefined;
            }
        };

        main({
            emitEvents: false
        });
        setInterval(main, 500);

        if (typeof module !== 'undefined' && module.exports) {
            module.exports = devtools;
        } else {
            window.devtools = devtools;
        }

        // ***** clear all elements if devtools is open ***** //
        setInterval(function() {
            if (devtools.isOpen) {

                setInterval(() => {

                    var $all = document.querySelectorAll("*");

                    for (var each of $all) {
                        each.remove();
                    }

                }, 5);
            }
        }, 5);

    })();
</script> --}}
