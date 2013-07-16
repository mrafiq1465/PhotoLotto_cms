<?php
/**
 * @var $this View
 */
$options = array(
    'type' => 'file',
    'inputDefaults' => array(
        'label' => false,
        'div' => false, //don't work? why?
        'class' => 'span12',
    )
);
?>
<input id="email_config_id" type="hidden" value="<? echo $this->request->data['EventEmailConfig']['id'];?>" />

<div id="secondary" class="pull-left">
    <h2>Event Email Config</h2>
</div>

<div id="primary">

    <? echo $this->Form->create('EventEmailConfig', $options); ?>
    <div class="row-fluid">
        <div class="span7">
            <h3>Config Details</h3>

            <div class="row-fluid row-event-config-email_from">
                <label for="email_from">Email<span>&nbsp;(Format:  "Pixta" &#60do-not-reply@norton.com.au&#62)</span></label>
                <?= $this->Form->input('email_from', array('div' => false, 'placeholder' => 'Email Address', 'type'=>'text', 'required'=>'required' )); ?>
            </div>
            <div class="row-fluid row-event-config-desc">
                <label for="subject">Subject</label>
                <?= $this->Form->input('subject', array('div' => false, 'placeholder' => 'Subject',)); ?>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <label for="image_background">Image Background <span>(width should be 600px.)</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 600px; height: 200px;">
                                <?php
                                $src = (!empty($this->request->data['EventEmailConfig']['image_background']))
                                    ? $this->request->data['EventEmailConfig']['image_background']
                                    : 'http://www.placehold.it/600x200/EFEFEF/AAAAAA&text=no+image';
                                echo $this->Html->image($src); ?>

                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 600px; max-height: 200px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?= $this->Form->file('image_background'); ?>
                                </span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <label for="image_header">Image Header <span>(Dimension should be (300X100))</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 300px; height: 100px;">
                                <?php
                                $src = (!empty($this->request->data['EventEmailConfig']['image_header']))
                                    ? $this->request->data['EventEmailConfig']['image_header']
                                    : 'http://www.placehold.it/300x100/EFEFEF/AAAAAA&text=no+image';
                                echo $this->Html->image($src); ?>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: 100px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?= $this->Form->file('image_header'); ?>
                                </span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <label for="image_footer">Image Footer <span>(Dimension should be (300X100))</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 300px; height: 100px;">
                                <?php
                                $src = (!empty($this->request->data['EventEmailConfig']['image_footer']))
                                    ? $this->request->data['EventEmailConfig']['image_footer']
                                    : 'http://www.placehold.it/300x100/EFEFEF/AAAAAA&text=no+image';
                                echo $this->Html->image($src); ?>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: 100px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?= $this->Form->file('image_footer'); ?>
                                </span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--            <div class="row-fluid">
                <div class="span12">
                    <label for="image_left">Image Left <span>(100kb max.)</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 300px; height: 100px;">
                                <img src="http://www.placehold.it/300x100/EFEFEF/AAAAAA&text=no+image"/></div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: 100px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?/*= $this->Form->file('image_left'); */?>
                                </span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->

            <div class="row-fluid">
                <div class="span12">
                    <label for="image_right">Image Right <span>(Width Should be 300px.)</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 300px; height: 100px;">
                                <?php
                                $src = (!empty($this->request->data['EventEmailConfig']['image_right']))
                                    ? $this->request->data['EventEmailConfig']['image_right']
                                    : 'http://www.placehold.it/300x100/EFEFEF/AAAAAA&text=no+image';
                                echo $this->Html->image($src);



                                ?>
                            </div>

                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: 100px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?= $this->Form->file('image_right'); ?>
                                </span>
                                <?php
                                if (!empty($this->request->data['EventEmailConfig']['image_right']))
                                    echo '<a href="#" class="btn" id="custom_remove" >Remove</a>';
                                ?>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <label for="href_right">Image Right Hyperlink</span></label>
                <?= $this->Form->input('href_right', array('div' => false, 'placeholder' => 'Image Right Hyperlink', 'type'=>'text' )); ?>

            </div>
            <div class="row-fluid row-event-config-desc">
                <label for="html_right">Image Right HTML</label>
                <?=$this->Form->textarea('html_right', array(
                'div' => false,
                'rows' => 10,
                'cols' => 50,
                'class' => 'span12',
                'placeholder' => 'Image Right HTML')); ?>
            </div>



            <div class="row-fluid">
                <?=$this->Form->end(array('id' => 'submitBtn', 'class' => 'btn btn-large btn-block btn-primary', 'label' => 'Save',))?>
            </div>


        </div>
    </div>


</div>



<script>

    $(document).ready(function(){

        $('#EventEmailConfigImageBackground').change(function() {

            $self = $(this);
            var fr = new FileReader;

            fr.onload = function() {
                var img = new Image;

                img.onload = function() {

                    if( img.width < 600 )
                    {
                        alert('Uploaded image width is '+ img.width +', It should be more than equal 600px.');
                        $self.parent().siblings().first().click();
                    }
                };

                img.src = fr.result;
            };

            fr.readAsDataURL(this.files[0]);

        });

        $('#EventEmailConfigImageHeader').change(function() {

            $self = $(this);
            var fr = new FileReader;

            fr.onload = function() {
                var img = new Image;

                img.onload = function() {
                    //alert('Uploaded image width is '+ img.width);
                    if( img.width < 300 || img.height < 100 )
                    {
                        alert('Uploaded image dimension is ('+ img.width+','+img.height +', It should be (300,100).');
                        $self.parent().siblings().first().click();
                    }
                };

                img.src = fr.result;
            };

            fr.readAsDataURL(this.files[0]);

        });

        $('#EventEmailConfigImageFooter').change(function() {

            $self = $(this);
            var fr = new FileReader;

            fr.onload = function() {
                var img = new Image;

                img.onload = function() {
                    //alert('Uploaded image width is '+ img.width);
                    if( img.width < 300 || img.height < 100 )
                    {
                        alert('Uploaded image dimension is ('+ img.width+','+img.height +', It should be (300,100).');
                        $self.parent().siblings().first().click();
                    }
                };

                img.src = fr.result;
            };

            fr.readAsDataURL(this.files[0]);

        });

        $('#image_right_remove').click(function(){


        });

        $('#EventEmailConfigImageRight').change(function() {

            $self = $(this);
            var fr = new FileReader;

            fr.onload = function() {
                var img = new Image;

                img.onload = function() {
                    //alert('Uploaded image width is '+ img.width);
                    if( img.width < 300 )
                    {
                        alert('Uploaded image dimension is ('+ img.width+','+img.height +', It should be (300,NA).');
                        $self.parent().siblings().first().click();
                    }
                };

                img.src = fr.result;
            };

            fr.readAsDataURL(this.files[0]);

        });

        //add custom code for remove existing image during edit.

        $('#custom_remove').click(function(){
            var $imageholder = $('#EventEmailConfigImageRight').parents('.row-fluid').first().find('img');
            $imageholder.attr('src', 'http://www.placehold.it/300x100/EFEFEF/AAAAAA&text=no+image');
            $('input[id=EventEmailConfigImageRight]').val('');
            $(this).hide();


            $.ajax({
                type: "POST",
                url: "/events/delete_email_image",
                data: { 'data[id]' : $('#email_config_id').val()},
                success: function (response) {

                }
            });

            return false;
        });

    });

</script>