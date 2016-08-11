@servers(['local' => 'juchao@192.168.0.235 -p 60000','test' => 'juchao@test.m.motif.me -p 60000','product' => 'juchao@m.motif.me -p 60000'])

{{--更新测试,预发M站 宏--}}
@macro('gitpullm')
localm
testm
@endmacro

{{--更新测试,预发PC站 宏--}}
@macro('gitpullpc')
localp
testp
@endmacro

{{--测试环境手机站--}}
@task('localm', ['on' => 'local'])
cd /export/App/motifM/ && git pull
@endtask

{{--测试环境PC站--}}
@task('localp', ['on' => 'local'])
cd /export/App/motifP/ && git pull
@endtask

{{--预发布环境PC站--}}
@task('testp', ['on' => 'test'])
cd /export/App/motifP/ && git pull
@endtask

{{--预发布环境手机站--}}
@task('testm', ['on' => 'test'])
cd /export/App/motifM/ && git pull
@endtask

{{--生产环境PC站--}}
@task('motifp', ['on' => 'product'])
cd /export/App/motifP/ && git pull
@endtask

{{--生产环境手机站--}}
@task('motifm', ['on' => 'product'])
cd /export/App/motifM/ && git pull
@endtask