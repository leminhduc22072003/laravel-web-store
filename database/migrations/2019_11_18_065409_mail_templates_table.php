<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('subject');
            $table->text('content');
            $table->string('variable', 1000);
            $table->timestamps();
        });

        \App\Models\MailTemplate::create
        ([
            'name' => 'User forgot password',
            'subject' => '[Mộc Thiên Long] Khôi phục mật khẩu',
            'content' => '"Chào bạn  {{$name}}

Bạn hoặc ai đó đã sử dụng chức năng khôi phục mật khẩu tại trang web mocthienlong.vn

Nếu bạn thực sự muốn đổi mật khẩu tài khoản của mình, nhấp vào liên kết dưới đây:

<a href="{{$link}}" target="_blank">Reset mật khẩu</a>

Bạn có thể bỏ qua thông báo của email này nếu bạn vẫn muốn sử dụng mật khẩu cũ của mình.

<b>Xin cám ơn.</b>"',
            'variable' => '{"name":"The name member register","link":"The change password link"}',
        ]);

        \App\Models\MailTemplate::create
        ([
            'name' => 'Thông báo đơn hàng',
            'subject' => '[Mộc Thiên Long] thông báo đơn hàng',
            'content' => '"Chào bạn  {{$name}}

Cám ơn bạn đã tin tưởng sản phẩm của Mộc Thiên Long.

Đơn hàng của bạn đã được hoàn tất, chúng tôi đã tạo cho bạn một tài khoản để kiểm tra đơn hàng

Tài khoản là: {{$username}}

Password: 123456

Để quản lý tài khoản vui lòng đăng nhập tại mocthienlong.vn

<b>Xin cám ơn.</b>"',
            'variable' => '{"name":"The name customer","username":"Username to login"}',
        ]);

        \App\Models\MailTemplate::create
        ([
            'name' => 'Thông báo đơn hàng',
            'subject' => '[Mộc Thiên Long] thông báo đơn hàng',
            'content' => '"Chào bạn  {{$name}}

Cám ơn bạn đã tin tưởng sản phẩm của Mộc Thiên Long.

Đơn hàng của bạn đã được hoàn tất

Vui lòng đăng nhập tại mocthienlong.vn để quản lý đơn hàng

<b>Xin cám ơn.</b>"',
            'variable' => '{"name":"The name customer"}',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_templates');
    }
}
