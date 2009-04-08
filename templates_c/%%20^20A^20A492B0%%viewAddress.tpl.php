<?php /* Smarty version 2.6.22, created on 2009-02-04 11:51:53
         compiled from viewAddress.tpl */ ?>

<h3>View Address</h3>

<table width="400">
       <tr> 
	    <td>Company Name:</td>
	    <td><?php echo $this->_tpl_vars['address']->company_name; ?>
</td>
       </tr>

       <tr>
	    <td>Address:</td>
	    <td><?php echo $this->_tpl_vars['address']->address; ?>
</td>
       </tr>

       <tr>
	    <td></td>
	    <td><?php echo $this->_tpl_vars['address']->address2; ?>
</td>
       </tr>

       <tr>
	    <td>City:</td>
	    <td><?php echo $this->_tpl_vars['address']->city; ?>
</td>
       </tr>

       <tr>
	    <td>State:</td>
	    <td><?php echo $this->_tpl_vars['address']->state; ?>
</td>
       </tr>

       <tr>
	    <td>Zip Code:</td>
	    <td><?php echo $this->_tpl_vars['address']->zipcode; ?>
</td>
       </tr>

       <tr>
	    <td>Phone Number:</td>
	    <td><?php echo $this->_tpl_vars['address']->phone; ?>
</td>
       </tr>

</table>

