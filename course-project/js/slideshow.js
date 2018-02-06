// Make the environment a bit friendlier
function $(expr, con) {
    return (con || document).querySelector(expr);
}

function $$(expr, con) {
    return [].slice.call((con || document).querySelectorAll(expr));
}

(function (head, body) {
// Cache <title> element, we may need it for slides that don't have titles
    var documentTitle = document.title + '';
    var self = window.SlideShow = function (container, slide) {

        // Set instance
        if (!window.slideshow) {
            window.slideshow = this;
        }

        this.container = container = container || body;

        // Current slide
        this.index = this.slide = slide || 0;

        // Current .delayed item in the slide
        this.item = 0;

        // Get the slide elements into an array^M
        this.items = this.slides = $$('.slide', container);

        // Order of the slides
        this.order = [];

        for (var i = 0; i < this.slides.length; i++) {
            var slide;
            slide = this.slides[i]; // to speed up references

            // Assign ids to slides that don't have one
            if (!slide.id) {
                slide.id = 'slide' + (i + 1);
            }

            // Set data-title attribute to the title of the slide
            if (!slide.title) {
                // no title attribute, fetch title from heading(s)
                var heading = $('hgroup', slide) || $('h1,h2,h3,h4,h5,h6', slide);

                if (heading && heading.textContent.trim()) {
                    slide.setAttribute('data-title', heading.textContent);
                }
            }
            else {
                // The title attribute is set, use that
                slide.setAttribute('data-title', slide.title);
                slide.removeAttribute('title');
            }

            slide.setAttribute('data-index', i);

            var imp = slide.getAttribute('data-import'),
                imported = imp ? this.getSlideById(imp) : null;

            this.order.push(imported ? +imported.getAttribute('data-index') : i);
        }

        // Event listeners
        document.addEventListener('keydown', this, false);
        addEventListener('hashchange', this, false);
        // If there's already a hash, update current slide number...
        this.handleEvent({type: 'hashchange'});

        // Rudimentary style[scoped] polyfill
        $$('style[scoped]', container).forEach(function (style) {
            var rules = style.sheet.cssRules,
                parentID = style.parentNode.id || self.getSlide(style).id;

            for (var j = rules.length; j--;) {
                var cssText = rules[j].cssText.replace(/^|,/g, function ($0) {
                    return '#' + parentID + ' ' + $0
                });

                style.sheet.deleteRule(0);
                style.sheet.insertRule(cssText, 0);
            }
        });

    };

    self.prototype = {
        handleEvent: function (evt) {
            switch (evt.type) {
                case 'keydown':
                    /**
                     Keyboard navigation
                     Home : First slide
                     End : Last slide
                     Space/Up/Right arrow : Next item/slide
                     Ctrl + Space/Up/Right arrow : Next slide
                     Down/Left arrow : Previous item/slide
                     Ctrl + Down/Left arrow : Previous slide
                     (Shift instead of Ctrl works too)
                     */
                    if (evt.target === body || evt.target === body.parentNode || evt.altKey) {
                        if (((evt.keyCode >= 32) && (evt.keyCode <= 37)) || (evt.keyCode == 39)) {
                            evt.preventDefault();
                        }

                        switch (evt.keyCode) {
                            case 33: //page up
                                this.previous();
                                break;
                            case 34: //page down
                                this.next();
                                break;
                            case 35: // end
                                this.end();
                                break;
                            case 36: // home
                                this.start();
                                break;
                            case 37: // <-
                                this.previous(evt.ctrlKey || evt.shiftKey);
                                break;
                            case 32: // space
                            case 39: // ->
                                this.next(evt.ctrlKey || evt.shiftKey);
                                break;
                        }
                    }
                    break;

                case 'hashchange':
                    this.goto(location.hash.substr(1) || 0);
                    break;
            }
        },

        start: function () {
            this.goto(0);
        },

        end: function () {
            this.goto(this.slides.length - 1);
        },

        /**
         @param hard {Boolean} Whether to advance to the next slide (true) or
         just the next step (which could very well be showing a list item)
         */
        next: function (hard) {
            if (!hard && this.items.length) {
                this.nextItem();
            }
            else {
                this.goto(this.index + 1);

                this.item = 0;

                // Mark all items as not displayed, if there are any
                if (this.items.length) {
                    for (var i = 0; i < this.items.length; i++) {
                        if (this.items[i].classList) {
                            this.items[i].classList.remove('displayed');
                            this.items[i].classList.remove('current');
                        }
                    }
                }
            }
        },

        nextItem: function () {
            if (this.item < this.items.length) {
                this.gotoItem(++this.item);
            }
            else {
                this.item = 0;
                this.next(true);
            }
        },

        previous: function (hard) {
            if (!hard && this.item > 0) {
                this.previousItem();
            }
            else {
                this.goto(this.index - 1);

                this.item = this.items.length;

                // Mark all items as displayed, if there are any
                if (this.items.length) {
                    for (var i = 0; i < this.items.length; i++) {
                        if (this.items[i].classList) {
                            this.items[i].classList.add('displayed');
                        }
                    }

                    // Mark the last one as current
                    var lastItem = this.items[this.items.length - 1];

                    lastItem.classList.remove('displayed');
                    lastItem.classList.add('current');
                }
            }
        },

        previousItem: function () {
            this.gotoItem(--this.item);
        },

        /**
         Go to an aribtary slide
         @param which {String|Integer} Which slide (identifier or slide number)
         */
        goto: function (which) {
            var slide;

            // We have to remove it to prevent multiple calls to goto messing up
            // our current item (and there's no point either, so we save on performance)
            window.removeEventListener('hashchange', this, false);

            var id;

            if (which + 0 === which && which in this.slides) {
                // Argument is a valid slide number
                this.index = which;
                this.slide = this.order[which]

                slide = this.slides[this.slide];

                location.hash = '#' + slide.id;
            }
            else if (which + '' === which) { // Argument is a slide id^M
                slide = this.getSlideById(which);

                if (slide) {
                    this.slide = this.index = +slide.getAttribute('data-index');
                    location.hash = '#' + which;
                }
            }

            if (slide) { // Slide actually changed, perform any other tasks needed
                document.title = slide.getAttribute('data-title') || documentTitle;

                // Update items collection
                this.items = $$('.delayed, .delayed-children > *', this.slides[this.slide]);
                this.item = 0;

                this.projector && this.projector.goto(which);

                // Update next/previous
                for (var i = this.slides.length; i--;) {
                    this.slides[i].classList.remove('previous');
                    this.slides[i].classList.remove('next');
                }

                this.slides.previous = this.slides[this.order[this.index - 1]];
                this.slides.next = this.slides[this.order[this.index + 1]];

                this.slides.previous && this.slides.previous.classList.add('previous');
                this.slides.next && this.slides.next.classList.add('next');
            }

            // If you attach the listener immediately again then it will catch the event
            // We have to do it asynchronously
            var me = this;
            setTimeout(function () {
                addEventListener('hashchange', me, false);
            }, 1000);
        },

        gotoItem: function (which) {
            this.item = which;

            var items = this.items, classes;

            for (var i = items.length; i-- > 0;) {
                classes = this.items[i].classList;

                classes.remove('current');
                classes.remove('displayed');
            }

            for (var i = this.item - 1; i-- > 0;) {
                this.items[i].classList.add('displayed');
            }

            if (this.item > 0) {
                this.items[this.item - 1].classList.add('current');
            }

            this.projector && this.projector.gotoItem(which);
        },

        getSlideById: function (id) {
            return $('.slide#' + id, this.container);
        }
    };

    /**********************************************
     * Static methods
     **********************************************/

// Helper method for plugins
    self.getSlide = function (element) {
        var slide = element;

        while (slide && slide.classList && !slide.classList.contains('slide')) {
            slide = slide.parentNode;
        }

        return slide;
    }

})(document.head || document.getElementsByTagName('head')[0], document.body);
