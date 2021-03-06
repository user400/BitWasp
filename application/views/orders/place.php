        <div class="span9 mainContent" id="my-orders">
		  <h2>Review Order</h2>
		  <?php if(isset($returnMessage)) echo '<div class="alert">'.$returnMessage.'</div>'; ?>
		  <?php echo form_open('order/place/'.$order['id'], array('name'=>'placeOrderForm','class' => 'form-horizontal')); ?>
            <fieldset>
			  <div class="row-fluid">
				<div class="span1 offset1">Vendor</div>
				<div class="span5"><?php echo anchor('user/'.$order['vendor']['user_hash'], $order['vendor']['user_name']); ?></div>
			  </div>

			  <div class="row-fluid">
				<div class="span1 offset1">Items</div>
				<div class="span5">
				  <ul>
				  <?php foreach($order['items'] as $item) { ?>
				    <li><?php echo $item['quantity'] . ' x ' . anchor('item/'.$item['hash'], $item['name']); ?></li>
				  <?php } ?>
				  </ul>					
				</div>				
			  </div>

			  <div class="row-fluid">
				<div class="span1 offset1">Price</div>
				<div class="span5">BTC <?php echo $order['price_b']; ?> 
<?php if($local_currency['id'] !== '0'); echo '<br />' . $local_currency['symbol'] . ' ' . $order['price_l']; ?></div>
			  </div>

<br />
			  <div class="row-fluid">
				<div class="span1 offset1"></div>
				<div class="span6">Enter your exact shipping address. You may choose to encrypt it using the vendors PGP public key before entering it. In fact, it will be encrypted before it leaves your browser if you have javascript enabled. </div>
			  </div>
			  
			  <div class="row-fluid">
				<div class="span1 offset1">Address</div>
				<div class="span7">
				  <textarea name='buyer_address' rows='5' class='span7'></textarea>
				</div>
                <span class="help-inline"><?php echo form_error('user_name'); ?></span>
			  </div>
			  
              <textarea style="display:none;" name="public_key"><?php if($order['vendor']['pgp']['public_key'] !== '') echo $order['vendor']['pgp']['public_key']; ?></textarea>

              <div class="form-actions">
                <input type='submit' class="btn btn-primary" value='Place Order' onclick='messageEncrypt()' />
                <?php echo anchor('order/list', 'Cancel', 'title="Cancel" class="btn"');?>
              </div>

            </fieldset>
          </form>
		</div>
