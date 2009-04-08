<?php /* Smarty version 2.6.22, created on 2009-04-15 14:48:21
         compiled from viewBusinesses.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'viewBusinesses.tpl', 228, false),)), $this); ?>

<?php if ($this->_tpl_vars['authority'] > 1): ?>
	<div class="TopOfTable"><span class="TopOfTable">
    <h3>Businesses</h3>
	<a href="addBusiness.php">Add new business</a>
	</span></div>
	<table width="900" bsort="0" class="itemsTable" cellspacing="0">
	       <tr>
	   
            <th width="200">
            <?php if (! isset ( $this->_tpl_vars['sort'] )): ?>
        <a class="tableHeaderLink" href="?sort=company_name&sortdir=DESC">
          Company Name
          <img src="images/sortTriangleUp.png" />
        </a>
      <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'company_name' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
        <a class="tableHeaderLink" href="?sort=company_name&sortdir=DESC">
          Company Name
          <img src="images/sortTriangleUp.png" />
        </a>
      <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'company_name' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
        <a class="tableHeaderLink" href="?sort=company_name">
          Company Name
          <img src="images/sortTriangleDown.png" />
        </a>
      <?php else: ?>
        <a class="tableHeaderLink" href="?sort=company_name&sortdir=DESC">
          Company Name
        </a>
      <?php endif; ?>
      </th>
      
      			<th width="150">
		  <?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'address' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		    <a class="tableHeaderLink" href="?sort=address&sortdir=DESC">
		      Address
		      <img src="images/sortTriangleUp.png" />
		    </a>
		  <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'address' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		    <a class="tableHeaderLink" href="?sort=address">
		      Address
		      <img src="images/sortTriangleDown.png" />
		    </a>
		  <?php else: ?>  
		    <a class="tableHeaderLink" href="?sort=address">
		      Address
		    </a>
		  <?php endif; ?>
		  </th>
		  
		  			<th width="160">
		  <?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'address2' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
		    <a class="tableHeaderLink" href="?sort=address2&sortdir=DESC">
		      Address 2
		      <img src="images/sortTriangleUp.png" />
		    </a>
		  <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'address2' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		    <a class="tableHeaderLink" href="?sort=address2">
		      Address 2
		      <img src="images/sortTriangleDown.png" />
		    </a>
		  <?php else: ?>
		    <a class="tableHeaderLink" href="?sort=address2">
		      Address 2
		    </a>
		  <?php endif; ?>
		  </th>
		  
		  			<th width="100">
			<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'city' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
			 <a class="tableHeaderLink" href="?sort=city&sortdir=DESC">
			   City
			   <img src="images/sortTriangleUp.png" />
			 </a>
		  <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'city' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		    <a class="tableHeaderLink" href="?sort=city">
			   City
			   <img src="images/sortTriangleDown.png" />
			 </a>
		  <?php else: ?>
		    <a class="tableHeaderLink" href="?sort=city">
			   City
			 </a>
		  <?php endif; ?>
		  </th>
		  
		  			<th width="20">
			<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'state' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
			 <a class="tableHeaderLink" href="?sort=state&sortdir=DESC">
			   State
			   <img src="images/sortTriangleUp.png" />
			 </a>
		  <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'state' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		   <a class="tableHeaderLink" href="?sort=state">
			   State
			   <img src="images/sortTriangleDown.png" />
			 </a>
		  <?php else: ?>
		    <a class="tableHeaderLink" href="?sort=state">
			   State
			 </a>
			 <?php endif; ?>
		  </th>
		  
		  			<th width="100">
			<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'zipcode' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
			 <a class="tableHeaderLink" href="?sort=zipcode&sortdir=DESC">
			   Zip Code
			   <img src="images/sortTriangleUp.png" />
			 </a>
		  <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'zipcode' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		    <a class="tableHeaderLink" href="?sort=zipcode">
			   Zip Code
			   <img src="images/sortTriangleDown.png" />
			 </a>
		  <?php else: ?>
		    <a class="tableHeaderLink" href="?sort=zipcode">
			   Zip Code
			 </a>
		  <?php endif; ?>
		  </th>
		  
		  			<th width="100">
			<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'phone' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
			 <a class="tableHeaderLink" href="?sort=phone&sortdir=DESC">
			   Phone Number
			   <img src="images/sortTriangleUp.png" />
			 </a>
		  <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'phone' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		    <a class="tableHeaderLink" href="?sort=phone">
			   Phone Number
			   <img src="images/sortTriangleDown.png" />
			 </a>
		  <?php else: ?>
		    <a class="tableHeaderLink" href="?sort=phone">
			   Phone Number
			 </a>
		  <?php endif; ?>
		  </th>
		  
		  			<th width="100">
			<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'fax' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
			 <a class="tableHeaderLink" href="?sort=fax&sortdir=DESC">
			   Fax Number
			   <img src="images/sortTriangleUp.png" />
			 </a>
		  <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'fax' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
			 <a class="tableHeaderLink" href="?sort=fax">
			   Fax Number
			   <img src="images/sortTriangleDown.png" />
			 </a>
			 <?php else: ?>
			   <a class="tableHeaderLink" href="?sort=fax">
			    Fax Number
  			 </a>
  		  <?php endif; ?>
		  </th>
		  
		  			<th width="100">
			<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'email' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
			 <a class="tableHeaderLink" href="?sort=email&sortdir=DESC">
			   Email
			   <img src="images/sortTriangleUp.png" />
			 </a>
		  <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'email' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
			 <a class="tableHeaderLink" href="?sort=email">
			   Email
			   <img src="images/sortTriangleDown.png" />
			 </a>
		  <?php else: ?>
  			 <a class="tableHeaderLink" href="?sort=email&sortdir=DESC">
	   		   Email
  			 </a>
		  <?php endif; ?>
		  </th>
		  
		  			<th width="150">
			<?php if (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'website' && ! isset ( $this->_tpl_vars['sortdir'] )): ?>
			 <a class="tableHeaderLink" href="?sort=website&sortdir=DESC">
			   Website
			   <img src="images/sortTriangleUp.png" />
			 </a>
		  <?php elseif (isset ( $this->_tpl_vars['sort'] ) && $this->_tpl_vars['sort'] == 'website' && $this->_tpl_vars['sortdir'] == 'DESC'): ?>
		    <a class="tableHeaderLink" href="?sort=website">
			   Website
			   <img src="images/sortTriangleDown.png" />
			 </a>
		  <?php else: ?>
		    <a class="tableHeaderLink" href="?sort=website">
			   Website
			 </a>
			 <?php endif; ?>
		  </th>
		  
		</tr>

	<?php unset($this->_sections['busLoop']);
$this->_sections['busLoop']['name'] = 'busLoop';
$this->_sections['busLoop']['loop'] = is_array($_loop=$this->_tpl_vars['businesses']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['busLoop']['show'] = true;
$this->_sections['busLoop']['max'] = $this->_sections['busLoop']['loop'];
$this->_sections['busLoop']['step'] = 1;
$this->_sections['busLoop']['start'] = $this->_sections['busLoop']['step'] > 0 ? 0 : $this->_sections['busLoop']['loop']-1;
if ($this->_sections['busLoop']['show']) {
    $this->_sections['busLoop']['total'] = $this->_sections['busLoop']['loop'];
    if ($this->_sections['busLoop']['total'] == 0)
        $this->_sections['busLoop']['show'] = false;
} else
    $this->_sections['busLoop']['total'] = 0;
if ($this->_sections['busLoop']['show']):

            for ($this->_sections['busLoop']['index'] = $this->_sections['busLoop']['start'], $this->_sections['busLoop']['iteration'] = 1;
                 $this->_sections['busLoop']['iteration'] <= $this->_sections['busLoop']['total'];
                 $this->_sections['busLoop']['index'] += $this->_sections['busLoop']['step'], $this->_sections['busLoop']['iteration']++):
$this->_sections['busLoop']['rownum'] = $this->_sections['busLoop']['iteration'];
$this->_sections['busLoop']['index_prev'] = $this->_sections['busLoop']['index'] - $this->_sections['busLoop']['step'];
$this->_sections['busLoop']['index_next'] = $this->_sections['busLoop']['index'] + $this->_sections['busLoop']['step'];
$this->_sections['busLoop']['first']      = ($this->_sections['busLoop']['iteration'] == 1);
$this->_sections['busLoop']['last']       = ($this->_sections['busLoop']['iteration'] == $this->_sections['busLoop']['total']);
?>
		 <tr<?php echo smarty_function_cycle(array('values' => " class=\"alt\","), $this);?>
>
		 	   <td align="center"><?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->company_name; ?>
</td>
			   <td align="center"><?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->address; ?>
</td>
			   <td align="center"><?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->address2; ?>
</td>
			   <td align="center"><?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->city; ?>
</td>
			   <td align="center"><?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->state; ?>
</td>
			   <td align="center"><?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->zipcode; ?>
</td>
			   <td align="center"><?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->phone; ?>
</td>
			   <td align="center"><?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->fax; ?>
</td>
			   <td align="center"><a href="mailto:<?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->email; ?>
"><?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->email; ?>
</td>
			   <td align="center"><a href="<?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->website; ?>
"><?php echo $this->_tpl_vars['businesses'][$this->_sections['busLoop']['index']]->website; ?>
</td>


    		</tr>
	<?php endfor; endif; ?>	


	</table>
<?php else: ?>
    <h3>Businesses</h3>

    <p>Please login if you wish to view information about businesses.</p>
<?php endif; ?>