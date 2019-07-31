
<template>
    <div class="backTop" @click="backToTop">
        <a href="#" role="button" data-toggle="button"></a>
    </div>
</template>

<script>
    export default {
        methods: {
            initToTopButton: function() {
            $(document).bind('scroll', function() {
                var backToTopButton = $('.backTop');
                if ($(document).scrollTop() > 250) {
                backToTopButton.addClass('show');
                this.isVisible = true;
                } else {
                backToTopButton.removeClass('show');
                this.isVisible = false;
                }
            }.bind(this));
            },
            backToTop: function() {
            $('html,body').stop().animate({
                scrollTop: 0
            }, 'slow', 'swing');
            }
        },
        mounted() {
            this.$nextTick(function() {
            this.initToTopButton();
            });
        },
    }
</script>