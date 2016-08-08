<script>

    function switchImpr(Impr) {
        // 当前视窗浏览位置
        var CurrentPosition = $(window).scrollTop() + $(window).height();
        // 元素本身聚顶部高度
        var ItemPosition = $(Impr).offset().top;

        // 如果是曝光项，加上本身的高度
        // 完全出现在视窗内时，再曝光
        if ($(Impr).is('a')) {
            ItemPosition += $(Impr).height();
        }

        // 判断是否在视窗内
        if (ItemPosition <= CurrentPosition) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * pushAjax - 依次发送 ajax 请求，遍历所有项
     *
     * @param  { Object } $Item 需要曝光的项
     */
    function pushAjax($Item) {
        $.each($Item, function(index, element) {
            if (switchImpr(element)) {
                var impr = $(element).data('impr');
                $(element).removeAttr('data-impr');
                $.ajax({
                            url: impr
                        })
                        .always(function() {
                            //$(element).removeAttr('data-impr');
                        });
            }
        });
    }

    function imprList() {
        var $ImprList = $('[data-impr]');
        if ($ImprList.length !== 0) {
            pushAjax($ImprList);
        }
    }

    $(document).ready(function() {
        $('[data-clk]').click(function() {
            var $this = $(this);
            if(undefined !== $this.data('link')){
                $.ajax({
                    url: $this.data('clk'),
                    type: "GET"
                });
                setTimeout(function() {
                    window.location.href = $this.data('link');
                }, 100);
            }
        })

        $(document).on('scroll', function(event) {
           imprList();
        });
    })
</script>

<script src="http://clk.motif.me/wl.js"></script>
