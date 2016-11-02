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
        $.each($Item, function (index, element) {
            if (switchImpr(element)) {
                var impr = $(element).data('impr');
                $(element).removeAttr('data-impr');

                $.ajax({
                    url: impr
                })
                        .always(function () {
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

    $(document).ready(function () {
        $('[data-clk]').unbind('click');
        $('[data-clk]').click(function () {
            var $this = $(this);
            $('#productClick-name').val($this.data('title'));
            $('#productClick-spu').val($this.data('spu'));
            $('#productClick-price').val($this.data('price'));

            //onProductClick();
            $.ajax({
                url: $this.data('clk'),
                type: "GET"
            });
            if (undefined !== $this.data('link')) {
                setTimeout(function () {
                    window.location.href = $this.data('link');
                }, 100);
            }
        })

        $(document).on('scroll', function (event) {
            imprList();
        });

        //收藏服务
        $('.btn-wished').click(function (e) {
            var $this = $(e.target);
            var spu = $this.data('spu');
            if (spu != undefined) {
                if (!$this.hasClass('active')) {
                    $this.addClass('active');
                } else {
                    $this.removeClass('active');
                }
                $.ajax({
                    url: '/updateWish',
                    type: 'post',
                    data: {spu: spu}
                });
            } else {
                spu = $this.data('actionspu');
                $.ajax({
                    url: '/notesaction',
                    type: 'get',
                    data: {
                        action: 'wish',
                        spu: spu
                    }
                })
                        .done(function (data) {
                            window.location.href = '/login';
                        });
            }

        });
    })
</script>
@if($_SERVER['SERVER_NAME'] == 'm.motif.me')
    <script src="{{ config('app.clk_url') }}/wl.js"></script>
@endif
