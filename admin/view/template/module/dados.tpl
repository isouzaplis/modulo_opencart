<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
</div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
   <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
  </div>
  <div class="content">      
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="dados_status">
                <?php if ($dados_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
		  <tr>
            <td>Campo CPF é obrigatório?</td>
            <td><select name="dados_cpf">
                <?php if ($dados_cpf) { ?>
                <option value="1" selected="selected">Sim</option>
                <option value="0">Não</option>
                <?php } else { ?>
                <option value="1">Sim</option>
                <option value="0" selected="selected">Não</option>
                <?php } ?>
              </select></td>
          </tr>
		  <tr>
            <td>Campo CNPJ é obrigatório?</td>
            <td><select name="dados_cnpj">
                <?php if ($dados_cnpj) { ?>
                <option value="1" selected="selected">Sim</option>
                <option value="0">Não</option>
                <?php } else { ?>
                <option value="1">Sim</option>
                <option value="0" selected="selected">Não</option>
                <?php } ?>
              </select></td>
          </tr>
		   <tr>
            <td>Campo Data de Nascimento é obrigatório?</td>
            <td><select name="dados_nascimento">
                <?php if ($dados_nascimento) { ?>
                <option value="1" selected="selected">Sim</option>
                <option value="0">Não</option>
                <?php } else { ?>
                <option value="1">Sim</option>
                <option value="0" selected="selected">Não</option>
                <?php } ?>
              </select></td>
          </tr>
	  </table>  
    </form>
  </div>
</div>

<?php echo $footer; ?>