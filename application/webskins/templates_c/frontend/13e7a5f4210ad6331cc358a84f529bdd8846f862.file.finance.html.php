<?php /* Smarty version Smarty-3.0.7, created on 2017-07-24 21:18:42
         compiled from "/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/news/finance.html" */ ?>
<?php /*%%SmartyHeaderCode:1478068083597601c21b3e39-95208928%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13e7a5f4210ad6331cc358a84f529bdd8846f862' => 
    array (
      0 => '/home/mocmien/domains/mocmien.net/public_html/webskins/templates/frontend/news/finance.html',
      1 => 1500905919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1478068083597601c21b3e39-95208928',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<style type="text/css">
    #deceased {
        background-color: #cefda7;
        padding-top: 10px;
        margin-bottom: 10px;
    }
    
    .remove_field {
        float: right;
        cursor: pointer;
        position: absolute;
    }
    
    .remove_field:hover {
        text-decoration: none;
    }
</style>
<div class="panel panel-primary" style="margin:20px;">
    <div class="panel-heading">
        <h3 class="panel-title">Đấu giá</h3>
    </div>
    <div class="panel-body">
        <form>
            <div class="col-md-12 col-sm-12">
                <div class="form-group col-md-6 col-sm-6">
                    <label for="name">Thời gian đặt lệnh từ 0h đến 22h</label>
                </div>
                <div class="form-group col-md-3 col-sm-3"></div>
                <div class="form-group col-md-3 col-sm-3">
                    <label for="months">Tên nhà đầu tư: <?php echo $_smarty_tpl->getVariable('user_info')->value['fullname'];?>
</label>
                    <span class="help-block">Ký hiệu NĐT: <?php echo $_smarty_tpl->getVariable('user_info')->value['ndt_id'];?>
</span> <?php if ($_smarty_tpl->getVariable('currentBid')->value['user_code']!=''){?>
                    <span class="help-block">Gía hiện tại: <?php echo number_format($_smarty_tpl->getVariable('currentBid')->value['price'],0,".",",");?>
</span>
                    <span class="help-block">Số lượng cổ phần đã đặt: <?php echo number_format($_smarty_tpl->getVariable('currentBid')->value['num_stocks'],0,".",",");?>
</span> <?php }else{ ?>
                    <span class="help-block">Bạn chưa đặt giá</span> <?php }?>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group col-md-3 col-sm-3">
                    <label for="years">Giá NĐT đặt mua 01 cổ phần (đơn vị: 1000đ, tối thiểu 2 triệu đồng) </label>
                </div>
                <div class="form-group col-md-3 col-sm-3">
                    <input type="text" class="form-control input-sm" id="price" placeholder="">
                </div>
                <div class="form-group col-md-6 col-sm-6">
                    <div class="notice"></div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group col-md-3 col-sm-3">
                    <label for="pincode">Số cổ phần muốn mua (là bội của 10) </label>
                </div>
                <div class="form-group col-md-3 col-sm-3">
                    <input type="text" class="form-control input-sm" id="quantity" placeholder="">
                </div>
            </div>
            <div class="col-md-12 col-sm-12" id="addblock">
                <div class="form-group col-md-3 col-sm-3">
                    <input type='button' class="btn btn-primary" value="Đặt lệnh" id="bid" />
                </div>
            </div>
            <div class="col-md-12 col-sm-12" id="deceased">
                <div class="form-group col-md-12 col-sm-12">
                    <label for="name">Giá 01 cổ phần được đặt mua cao nhất hiện tại:  <?php echo number_format($_smarty_tpl->getVariable('max_price')->value,0,".",",");?>
 VND</label>
                </div>
                <div class="form-group col-md-12 col-sm-12">
                    <label for="gender">Giá khớp tạm thời: <?php echo number_format($_smarty_tpl->getVariable('temp_price')->value,0,".",",");?>
 VND</label>
                </div>
            </div>
        </form>
    </div>
    </body>

    </html>