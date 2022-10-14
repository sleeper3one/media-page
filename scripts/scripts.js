'use strict';

const sb = {
    activeSection: 'cover',

    init: function() {
        let navLinks = document.querySelectorAll('.slider-nav')
        for (let el of navLinks) {
            el.addEventListener('click', sb.sliderAction, false)
        }
        if (typeof sbInitInfluencers != 'undefined' && sbInitInfluencers === 1) {
            sb.influencersSelector()
        }
        var lightbox = new Lightbox()
        lightbox.load(lightboxObj)
        sb.initScrolling()

        let checkboxes = document.querySelectorAll('.field-checkbox')
        for (let el of checkboxes) {
            el.addEventListener('click', sb.checkboxStatus, false)
        }

        let formCtaBtn = document.querySelector('.btn-cta-form')
        if (formCtaBtn && typeof formCtaBtn != 'undefined') {
            formCtaBtn.addEventListener('click', sb.sendForm, false)
        }
    },

    sendForm: function(e) {
        e.preventDefault()
        var formId = 'contact-form'
        var valid = sb.validateForm(formId)

        if (!valid) {
            return
        }

        let privacyIsChecked = document
            .getElementById('form-agreement')
            .classList.contains('is-checked')
        let dataObj = {
            action: 'addlead',
            first_name: document.getElementById('contact-first_name').value,
            last_name: document.getElementById('contact-last_name').value,
            email: document.getElementById('contact-email').value,
            telephone: document.getElementById('contact-telephone').value,
            content: document.getElementById('contact-content').value,
            lead_privacy: privacyIsChecked,
        }

        let btn = document.querySelector('.btn-cta-form')
        let successInfo = document.querySelector('.form-success-msg')
        btn.classList.add('btn-working')

        fetch(actionUrl, {
                method: 'POST',
                body: JSON.stringify(dataObj),
            })
            .then(function(response) {
                return response.text()
            })
            .then(function(html) {
                let ret = JSON.parse(html)
                btn.classList.remove('btn-working')
                if (ret.success == true) {
                    btn.classList.add('btn-gone')
                    successInfo.innerHTML = ret.msg
                    successInfo.classList.add('on-air')
                } else {
                    successInfo.innerHTML = ret.msg
                    successInfo.classList.add('on-air')
                }
                return
            })
    },

    checkboxStatus: function() {
        let isChecked = this.classList.contains('is-checked')
        if (!isChecked) {
            this.classList.add('is-checked')
        } else {
            this.classList.remove('is-checked')
        }
    },

    showJobId: 1,
    showJobOffer: function(id) {
        let links = document.querySelectorAll('.job-select')
        let offers = document.querySelectorAll('.job-offer')
        console.log([links, offers])
        var index = -1
        for (let el of links) {
            index += 1
            let elId = el.dataset.id
            if (elId == id) {
                el.classList.add('on-air')
            } else {
                el.classList.remove('on-air')
                offers[index].classList.remove('on-air')
            }
            document.getElementById('job-' + id).classList.add('on-air')
        }
    },

    activeSlide: 1,
    slideDirection: 0,
    sliderAction: function(e) {
        e.preventDefault()
        var itemsInView = 5
        var sliderCont = document.querySelector('.slider-cont')
        var sliderItems = sliderCont.querySelectorAll('.slider-item')
        for (let item of sliderItems) {
            item.classList.remove('lethimrest')
        }

        var maxSlide = sliderItems.length - itemsInView + 1
        var sliderItemWidth = sliderItems[0].offsetWidth // / itemsInView;
        if (sliderCont.offsetWidth < 700) {
            itemsInView = 1
            maxSlide = sliderItems.length
        }
        var actionDirection = e.target.classList.contains('slider-nav-next') ?
            1 :
            -1
        var newSlide = parseInt(actionDirection) + parseInt(sb.activeSlide)
        newSlide = newSlide <= 1 ? 1 : newSlide > maxSlide ? maxSlide : newSlide
        sb.activeSlide = parseInt(newSlide)
        var newOffset = newSlide * sliderItemWidth - sliderItemWidth
        sliderCont.style.transform = 'translateX(-' + newOffset + 'px)'

        var prevSlide = sb.activeSlide - 1
        if (prevSlide > 0) {
            var letRestPrev = document.getElementById('slider-list-item-' + prevSlide)
            setTimeout(function() {
                letRestPrev.classList.add('lethimrest')
            }, 6)
        }

        var nextSlide = sb.activeSlide + itemsInView
        if (nextSlide <= sliderItems.length) {
            var letRestNext = document.getElementById('slider-list-item-' + nextSlide)
            setTimeout(function() {
                letRestNext.classList.add('lethimrest')
            }, 6)
        }
    },

    sliderInit: function() {
        var map = document.querySelectorAll('.neat-slider');
        [].forEach.call(map, function(el) {
            var itemWidth = el.offsetWidth
            var sliderWrapper = el.querySelector('.neat-slider-wrapper')
            var sliderItems =
                sliderWrapper.querySelectorAll('.neat-slider-item').length
            if (itemWidth > 650) {
                itemWidth = itemWidth / sliderItems.length
            }
            var wrapperWidth = itemWidth * sliderItems
            sliderWrapper.style.width = wrapperWidth + 'px'

            var items = sliderWrapper.querySelectorAll('.neat-slider-item')
            var itemHeight = 0;
            [].forEach.call(items, function(elItem) {
                elItem.style.width = itemWidth + 'px'
                itemHeight = elItem.offsetHeight
            })

            el.addEventListener('touchstart', neatApi.dragStart, false)
            el.addEventListener('touchend', neatApi.dragEnd, false)
        })
    },

    activeSlide: 1,
    showSlide: function(item, sliderId) {
        let sliderParent = document.getElementById('neat-slider-' + sliderId)
        let sliderItem = sliderParent.querySelectorAll('.neat-slider-item')
        let sliderWidth = sliderItem[0].offsetWidth //sliderParent.offsetWidth;
        let position = sliderWidth - sliderWidth * item
        let sliderWrapper = sliderParent.querySelector('.neat-slider-wrapper')
            //sliderWrapper.style.left = position + 'px';
        sliderWrapper.style.transform = 'translateX(' + position + 'px)'

        let map = sliderParent.querySelectorAll('.neat-slider-dot');
        [].forEach.call(map, function(el) {
            el.classList.remove('on-air')

            if (el.dataset.slide == item) {
                el.classList.add('on-air')
            }
        })
        neatApi.activeSlide = item
        sliderParent.dataset.slide = item
    },

    activeSection: null,
    fastSocialObj: document.getElementById('fast-social'),
    porftolioObj: document.getElementById('portfolio-slider'),
    initScrolling: function() {
        var wh = window.innerHeight
        if (sb.porftolioObj) {
            var bounding = sb.porftolioObj.getBoundingClientRect()
            var portfolioTop = bounding.y + bounding.height / 2
        }

        window.onscroll = function(ev) {
            let actY = window.pageYOffset + wh

            if (
                actY >= portfolioTop &&
                !sb.porftolioObj.classList.contains('lines-onair')
            ) {
                sb.porftolioObj.classList.add('lines-onair')
                sb.fastSocialObj.classList.add('docked')
            } else if (actY <= portfolioTop) {
                sb.porftolioObj.classList.remove('lines-onair')
                sb.fastSocialObj.classList.remove('docked')
            }
        }
    },

    isOnPerson: 0,
    influencersSelector: function() {
        let allPersons = document.querySelectorAll('.sb-person')
        for (let el of allPersons) {
            el.addEventListener('mouseover', isOnPerson, false)
            el.addEventListener('mouseout', isOffPerson, false)
        }

        function isOnPerson() {
            let thisOne = this
            for (let el of allPersons) {
                if (el != thisOne) {
                    el.classList.add('person-off')
                }
            }
        }

        function isOffPerson() {
            for (let el of allPersons) {
                el.classList.remove('person-off')
            }
        }
    },

    menuShow: function(e) {
        const navStatus = document.querySelector('nav').classList
        if (navStatus.contains('on-air')) {
            navStatus.remove('on-air')
        } else {
            navStatus.add('on-air')
        }
    },

    goToSection: function(e) {
        e.preventDefault()
        const hash = e.target.hash
        sb.activeSection = hash.replace('#', '')
        console.log(sb.activeSection)

        const navStatus = document.querySelector('nav').classList
        navStatus.remove('on-air')

        const target = document.getElementById(hash.replace('#', ''))
        target.scrollIntoView({
            behavior: 'smooth',
        })
    },

    validateForm: function(formId) {
        var errors = 0
        var errors_agrees = 0
        var form = document.getElementById(formId)

        var fieldsLabel = form.querySelector('.form-fields-error')
        var agreesLabel = form.querySelector('.form-agree-error')
        var agrees = form.querySelectorAll('.field-checkbox')
        var inputs = form.querySelectorAll('.form-field')
        for (let el of inputs) {
            let elVal = el.value
            let isReq = el.classList.contains('req')
            let isEmail = el.type

            if (isReq && (!elVal || elVal.length < 3)) {
                el.classList.add('field-error')
                errors++
            } else if (isEmail == 'email') {
                if (!sb.validateEmail(elVal)) {
                    el.classList.add('field-error')
                    errors++
                } else {
                    el.classList.remove('field-error')
                }
            } else {
                el.classList.remove('field-error')
            }
        }

        var agrees = form.querySelectorAll('.field-checkbox')
        for (let el of agrees) {
            let isReq = el.classList.contains('check-req')
            let isChecked = el.classList.contains('is-checked')
            if (isReq && !isChecked) {
                errors_agrees++
            }
        }

        if (errors > 0) {
            fieldsLabel.classList.add('on-air')
        } else {
            fieldsLabel.classList.remove('on-air')
        }
        if (errors_agrees > 0) {
            agreesLabel.classList.add('on-air')
        } else {
            agreesLabel.classList.remove('on-air')
        }

        return errors == 0 && errors_agrees == 0 ? true : false
    },

    validateEmail: function(el) {
        if (!/(.+)@(.+){1,}\.(.+){2,}/.test(el)) {
            return false
        } else {
            return true
        }
    },
}

sb.init()