<!DOCTYPE html>
<html lang="en">
<head>
    <title>Size Guide</title>
    @include('head')

</head>
<body>
@include('check.tagmanager')
<!-- 外层容器 -->
<div id="body-content">
    <!-- 展开的汉堡菜单 -->
@if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
    @include('nav')
@endif
<!-- 主体内容 -->
    @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
        <div class="body-container">
            @include('navigator')
            @else
                <div class="body-container" style="padding-top:0px">
                @endif
    <!-- 尺寸指南 -->
        <section class="m-b-20x p-b-20x reserve-height">
            <article class="font-size-md text-main p-x-15x p-y-10x"><strong>Size Guide</strong>
            </article>
            <div class="bg-white">
                <div class="p-a-15x font-size-sm text-primary">
                    <p class="m-b-15x"><strong>How to Find Your Ring Size?</strong></p>
                    <p class="m-b-15x">While the most precise way to find your ring size is to have a jeweler do it,
                        you can also easily
                        do it at home. Whether you're sizing your finger to buy a ring online, or want to surprise
                        your
                        sweetie with an engagement ring, the next method has you covered.</p>

                    <p class="m-b-15x"><strong>Finding Your Ring Size</strong></p>
                    <div class="m-b-15x">
                        <ol class="p-l-15x">
                            <li>Cut a strip of paper or a piece of string. Wrap the paper or string around the
                                finger to be sized.
                            </li>
                            <li>Slide the paper or string up to the knuckle, as the ring must be sized large enough
                                to able to slip off and on, over the knuckle.
                            </li>
                            <li>Mark the intersection point of string. Make sure to mark both points of the
                                string.
                            </li>
                            <li>Place the paper or string next to a ruler and write down your measurement.</li>
                            <li>Locate your ring size by locating your measurement on the size chart.</li>
                        </ol>
                    </div>
                    <p class="m-b-15x">
                        If the measurement falls in between two sizes, it is recommended that you choose the larger
                        size. Your fingers might also swell if you're pregnant or taking certain medications. Take
                        this
                        into account when measuring your fingers.
                    </p>

                    <div class="m-b-15x"><img class="img-fluid" src="{{env('CDN_Static')}}/images/sizeguild/gide-size.jpg" alt=""></div>

                    <p class="m-b-15x"><strong>Finding the Ring Size for Your Loved Ones</strong></p>
                    <div class="m-b-15x">
                        <ol class="p-l-15x">
                            <li>Find a ring that your loved one currently wears.</li>
                            <li>Make sure he or she wears that ring on the finger you are shopping for.</li>
                            <li>Using a ruler to measure the inside diameter or inside circumference of the ring.
                            </li>
                            <li>Match your measurement with our size chart to find your perfect fitting size!</li>
                        </ol>
                    </div>
                    <p class="m-b-15x">If the measurement falls in between two sizes, it is recommended that you
                        choose the larger size.</p>

                    <div class="m-b-15x">
                        <table class="table text-center">
                            <thead class="thead-default">
                            <tr>
                                <th class="">UK size</th>
                                <th class="">US size</th>
                                <th class="text-center">Inside diameter <br>(mm)</th>
                                <th class="text-center">Inside diameter <br>(mm)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>A</td>
                                <td>1/2</td>
                                <td>12.04</td>
                                <td>37.8</td>
                            </tr>
                            <tr>
                                <td>B</td>
                                <td>1</td>
                                <td>12.45</td>
                                <td>37.8</td>
                            </tr>
                            <tr>
                                <td>C</td>
                                <td>1/2</td>
                                <td>12.04</td>
                                <td>37.8</td>
                            </tr>
                            <tr>
                                <td>C</td>
                                <td>1/2</td>
                                <td>12.04</td>
                                <td>37.8</td>
                            </tr>
                            <tr>
                                <td>C</td>
                                <td>1/2</td>
                                <td>12.04</td>
                                <td>37.8</td>
                            </tr>
                            <tr>
                                <td>C</td>
                                <td>1/2</td>
                                <td>12.04</td>
                                <td>37.8</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </section>
        <!-- 页脚 功能链接 -->
        @if(!strstr($_SERVER['HTTP_USER_AGENT'], 'motif-android') && !strstr($_SERVER['HTTP_USER_AGENT'], 'motif-ios'))
            @include('footer')
        @endif
    </div>
</div>
</body>
<script src="{{env('CDN_Static')}}/scripts/vendor.js{{'?v='.config('app.version')}}"></script>
@include('global')
</html>
