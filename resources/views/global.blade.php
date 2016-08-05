<script>
    $(document).ready(function() {
        $('[data-clk]').click(function() {
            $this = $(this);
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

        $.ajax({
            url: $('[data-impr]').data('impr'),
            type: "GET"
        });
    })
</script>

<script src="http://clk.motif.me/wl.js"></script>
