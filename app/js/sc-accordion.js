$().ready(function(){
    $('.toggle').click(function(e) {
        e.preventDefault();
    
        var $this = $(this);

        // Show or hide content
        if ($this.next().hasClass('show')) {
            $this.next().removeClass('show');
            $this.next().slideUp(350);
        } else {
            $this.parent().parent().find('li .inner').removeClass('show');
            $this.parent().parent().find('li .inner').slideUp(350);
            $this.next().toggleClass('show');
            $this.next().slideToggle(350);
        }

        // Highlight current selection header
        if ($this.parent().hasClass('cats')){
            $('.active').removeClass('active');
            $this.parent().find('a:first').addClass('active');
        } else if ($this.parent().hasClass('subs')){
            $this.parent().parent().find('.active').removeClass('active');
            $this.parent().find('a:first').addClass('active');
        } else if ($this.parent().hasClass('preps')){
            $this.parent().parent().find('.active').removeClass('active');
            $this.parent().find('a:first').addClass('active');
        } else {
            $('.active').removeClass('active');
        }
    });
});