<?php /* Smarty version Smarty-3.0.7, created on 2017-08-04 23:54:04
         compiled from "E:\xampp\htdocs\VP9\application/webskins/templates/frontend/news/finance.html" */ ?>
<?php /*%%SmartyHeaderCode:112715984a6ac85fb95-98840661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '419e35d54bc7466b6acd1727d6a6b762620da875' => 
    array (
      0 => 'E:\\xampp\\htdocs\\VP9\\application/webskins/templates/frontend/news/finance.html',
      1 => 1501865642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112715984a6ac85fb95-98840661',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>



<div class="panel panel-primary" style="margin:20px;">
    <div class="panel-heading">
        <div class="row">
             <div class="col-md-6"> 
            <h3 class="panel-title">Đấu giá</h3>
            </div>
             <div class="col-md-6 box-count-time">
                <h3 class="panel-title">Thời gian còn lại: <span id="getting-started"></span> </h3>
				<input type="hidden" id="count_time"  value="<?php echo $_smarty_tpl->getVariable('count_time')->value;?>
" />
             </div>
        </div>
    </div>
    <div class="panel-body">
        <form class="form-inline">
            
            <div class="col-md-12 col-sm-12">
                <div class="col-md-6">                        
                    <div class="form-group ">
                        <label for="years">Giá đặt mua 01 cổ phần (Đơn vị: VND): </label>
                        <input type="text" class="form-control input-sm" id="price" placeholder="">
                    </div>
                    
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="years">Số cổ phần muốn mua:</label>
                         <input type="text" class="form-control input-sm" id="quantity" placeholder="">
                    </div>
                  
                    <div class="form-group" style="margin-top: 20px;display:block;">
                        <label>Trị giá đầu tư</label>
                        <span id="investment_val" class="form-control"></span>
                    </div>
                    
                    <div class="form-group" style="margin-top: 20px;margin-bottom:20px;display:block;">
						<input type="checkbox"  id="price_fix" name="price_fix" data-toggle="toggle">
                        <!--<input type="radio" id="price_fix" name="price_fix" /> --> <label class="form-control"> Đặt theo giá cao nhất</label>
                    </div>
                                     
                    <div class="form-group col-md-12 col-sm-12">
                        <div class="notice"></div>
                    </div>
                </div>
                
                <div class="col-md-6">                    
                    <div class="form-group" style="padding-left: 240px;">
                        <label for="months">Tên nhà đầu tư: <?php echo $_smarty_tpl->getVariable('user_info')->value['fullname'];?>
</label>
                        <span class="help-block"><b>Ký hiệu NĐT:</b> <?php echo $_smarty_tpl->getVariable('user_info')->value['ndt_id'];?>
</span> <?php if ($_smarty_tpl->getVariable('currentBid')->value['user_code']!=''){?>
                        <span class="help-block"><b>Giá hiện tại:</b> <?php echo number_format(($_smarty_tpl->getVariable('currentBid')->value['price']),0,".",",");?>
 VND</span>
                        <span class="help-block"><b>Số lượng cổ phần đã đặt:</b> <?php echo number_format($_smarty_tpl->getVariable('currentBid')->value['num_stocks'],0,".",",");?>

                        </span>
                        <span class="help-block"><b>Số tiền ký quỹ:</b> <?php echo number_format(($_smarty_tpl->getVariable('user_info')->value['sig_deposit_amt']),0,".",",");?>
 VND</span>
                         <?php }else{ ?>
                        <span class="help-block">Bạn chưa đặt giá</span> <?php }?>
                    </div>
                </div>
            
            </div>
           
            <div class="col-md-12 col-sm-12" id="addblock">
                <div class="form-group col-md-3 col-sm-3">
                    <input type='button' class="btn btn-primary" value="Đặt lệnh" id="bid" />
                </div>
            </div>
            
            <div class="col-md-12 col-sm-12" id="deceased">
                <div class="form-group col-md-12 col-sm-12">
                    <label for="name">Giá 01 cổ phần được đặt mua cao nhất hiện tại:  <?php echo number_format(($_smarty_tpl->getVariable('max_price')->value),0,".",",");?>
 VND</label>
                </div>
                <div class="form-group col-md-12 col-sm-12">
                    <label for="gender">Giá khớp tạm thời:
						<?php echo number_format(($_smarty_tpl->getVariable('temp_price')->value),0,".",",");?>
 VND					
					</label>
					
                </div>
            </div>
        </form>
    </div>
    </body>

    </html>