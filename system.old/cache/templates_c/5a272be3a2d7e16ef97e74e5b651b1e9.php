<?php if($form): ?>
    <table class="table  table-bordered table-hover table-condensed content_big_td">
        <thead>
            <tr>
                <th colspan="6">
                    <?php echo lang ("Additional fields", 'cfcm'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        <?php if(is_true_array($form->asArray())){ foreach ($form->asArray() as $f){ ?>
                            <div class="control-group">
                                <label class="control-label">
                                    <?php echo $f['label']; ?>
                                </label>
                                <div class="controls">

                                    <?php if($f['info']['enable_image_browser']  == 1): ?>
                                        <div class="group_icon pull-right">            
                                            <button class="btn btn-small" onclick="elFinderPopup('image', '<?php echo $f['name']; ?>');
                                                    return false;"><i class="icon-picture"></i>  <?php echo lang ("Select an image", 'cfcm'); ?></button>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($f['info']['enable_file_browser']  == 1): ?>
                                        <div class="group_icon pull-right">
                                            <button class="btn btn-small" onclick="elFinderPopup('file', '<?php echo $f['name']; ?>');
                                                    return false;"> <i class="icon-folder-open"></i> <?php echo lang ("Select a file", 'cfcm'); ?></button>
                                        </div>
                                    <?php endif; ?>

                                    <div class="o_h">		            
                                        <?php echo $f['field']; ?>
                                    </div>

                                    <?php echo $f['help_text']; ?>
                                </div>
                            </div>

                        <?php }} ?>
                        <?php if(isset($hf)){ echo $hf; } ?>

                        <?php echo form_csrf (); ?>
                    </div>

                    <div id="elFinder"></div>
                </td>
            </tr>
        </tbody>
    </table>
<?php else:?>
    <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
        <?php echo lang ("Group without any fields", 'cfcm'); ?>
    </div>
<?php endif; ?><?php $mabilis_ttl=1415876683; $mabilis_last_modified=1415789030; ///var/www/image-c.loc/application/modules/cfcm/templates/public/_onpage_form.tpl ?>