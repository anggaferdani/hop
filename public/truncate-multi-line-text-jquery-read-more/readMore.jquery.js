(function( $ ) {

    $.fn.readMore = function(options) {

        var settings = $.extend({
            numberOfLines : 5,
            endingTag : '&hellip;'
        }, options );

        function getWidth(pre_space, str, post_space, append_elem){
            var pre = (pre_space) ? '&nbsp;' : '';
            var post = (post_space) ? '&nbsp;' : '';

            var tmp_div = $('<span style="white-space: nowrap;">'+pre+str+post+'</span>');
            append_elem.append(tmp_div);
            var width =  tmp_div.width();
            tmp_div.remove();
            return width;
        }

        return this.each(function() {
            var width = $(this).width();
            var text = this.innerText;
            var words = text.split(' ');
            var line_width = 0;
            var current_line = '';
            var lines = [];
            var endingTagWidth = getWidth(false, settings.endingTag, false, $(this));
            for (index = 0;  index < words.length; index++) {
                var word = words[index];
                if(line_width == 0){
                    line_width += getWidth(false, word, false, $(this));
                }
                else {
                    line_width += getWidth(true, word, false, $(this));
                }

                if((lines.length + 1 == settings.numberOfLines && line_width > width - endingTagWidth) || (line_width  > width)){
                    lines.push(current_line);

                    if (lines.length == settings.numberOfLines) {
                        lines[settings.numberOfLines-1] = lines[settings.numberOfLines-1] + settings.endingTag;
                        break;
                    }

                    line_width = getWidth(false, word, false, $(this)); // new line
                    current_line = '';
                }
                current_line += ((current_line != '') ? ' ' : '') + word;

                if(index == (words.length-1)){
                    lines.push(current_line);
                    lines[settings.numberOfLines-1] = lines[settings.numberOfLines-1];
                }

            }
            this.innerHTML = lines.join(' ');
        })

    };

}( jQuery ));