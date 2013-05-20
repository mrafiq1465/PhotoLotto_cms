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

<div id="secondary" class="pull-left">
    <h2>Campaign Creator</h2>
    <nav id="event-menu">
        <ul>
            <li class="active"><a href="#event_details">Event Details</a></li>
            <li><a href="#overlay_images">Overlay Images</a></li>
            <li><a href="#social-media">Social Media</a></li>
            <li><a href="#campaign-settings">Campaign Settings</a></li>
            <li><a href="#custom-page">Custom Page</a></li>
        </ul>
    </nav>
</div>
<div id="primary">
<div class="tab-content" id="event_tabs">
<section id="event_details" class="tab-pane fade in active">
    <? echo $this->Form->create('Event', $options); ?>
    <div class="row-fluid">
        <div class="span7">
            <h3>Event Details</h3>

            <div class="row-fluid row-event-name">
                <label for="EventName">Event Name <span>(60 characters max.)</span></label>
                <?= $this->Form->input('name', array('div' => false, 'placeholder' => 'Event Name',)); ?>
            </div>
            <div class="row-fluid">
                <label for="password">Event Password</label>
                <?=$this->Form->input('event_password', array(
                'div' => false,
                'class' => 'not_required span12',
                'placeholder' => 'Password for Event')); ?>
            </div>

            <div class="row-fluid">
                <label for="shortdescription_line_1">Event Description <span>(60 characters max. per line)</span></label>
                <?= $this->Form->input('shortdescription_line_1', array('div' => false, 'placeholder' => 'Description 1: e.g. Brand the moment!',));?>
                <?= $this->Form->input('shortdescription_line_2', array('div' => false, 'placeholder' => 'Description 2: e.g. #PIXTA',));?>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <label for="public_logo">Event/Company Logo <span>(100kb max.)</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"/></div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?= $this->Form->file('public_logo'); ?>
                                </span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="span5">
            <img src="/images/iphone.jpg" alt="iPhone"/>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span7">
            <h3>Time</h3>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span7">
            <div class="row-fluid">
                <label for="date_start">Start Date</label>
                <?=$this->Form->input('date_start', array('empty' => false, 'div' => false, 'minYear'=>date('Y'), 'maxYear'=>date('Y')+10, 'placeholder' => 'Please choose a start date', 'type' => "date"));?>
            </div>
            <div class="row-fluid">
                <label for="date_end">End Date</label>
                <?=$this->Form->input('date_end', array('empty' => false, 'minYear'=>date('Y'), 'maxYear'=>date('Y')+10, 'div' => false, 'placeholder' => 'Please choose a start date', 'type' => "date"));?>
            </div>
        </div>
        <div class="span5">
            <aside class="help">
                Dates will be inclusive, meaning
                your event will begin at the
                commencement of the start
                date and finish at the close of the
                end date.
            </aside>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span7">
            <h3>Location</h3>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span7">
            <div class="row-fluid">
                <label for="public_address">Address</label>
                <?=$this->Form->input('public_address', array('div' => false, 'placeholder' => 'e.g. 38/110 Bourke Rd, Alexandria, NSW, 2015',)) ?>
            </div>
            <div class="row-fluid">
                <label for="gpslat">Latitude</label>
                <?=$this->Form->input('gpslat', array('div' => false, 'placeholder' => 'e.g. -33.887072',));?>
            </div>
            <div class="row-fluid">
                <label for="gpslong">Longitude</label>
                <?=$this->Form->input('gpslong', array('div' => false, 'placeholder' => 'e.g. -33.887072',));?>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <div class="span7">
                            <label for="eventtype">Event Type</label>
                            <?=$this->Form->input('eventtype',
                                array(
                                    'div' => false,
                                    'class'=> 'span12',
                                    'options' => array(
                                        'pixta-play' => 'PIXTA Play',
                                        'National' => 'National',
                                        'location-based' => 'Location Based'),
                                        'default' => 'pixta-play'
                                ));?>
                        </div>
                        <div class="span5">
                            <label for="event_radius">Radius <span>(in kilometres)</span></label>
                            <?=$this->Form->input('event_radius', array('div' => false, 'placeholder' => 'radius', 'type' => 'text'));?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="span5">
            <aside class="help">
                <div>Please specify your event’s active radius if it is location based</div>
                <div>Users outside of this radius will not be able to see your event</div>
            </aside>
        </div>
    </div>
</section>
<section id="overlay_images" class="tab-pane fade">
    <div class="row-fluid">
        <div class="span5">
            <h3>Overlay Images</h3>

            <p>
                Overlays are the main attraction of
                combining your brand and Pixta.
            </p>

            <p>Your designs will be integrated
                with consumer photos and can
                incorporate graphics, logos and other
                brand messages.</p>

            <aside class="help">
                <div>Dimensions: 600 x 600 <br>Image type: PNG</div>
                <div>For best results use simple graphics
                    and logo placements. Always upload
                    files with transparent backgrounds.
                </div>

            </aside>

            <? for ($i=1; $i<=5; $i++) { ?>
            <div class="row-fluid">
                <?=$this->Form->file("img_overlay_$i", array('div' => false, 'class' => 'overlay-img-upload')); ?>
            </div>
            <? } ?>
        </div>
        <div class="span7">
            <div class="row-fluid">
                <div class="img-container span12 big">
                    <img id="overlay-img-selected" src="/images/dummy.jpg" alt="dummy"/>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <?for ($i=1; $i<=5; $i++) { ?>
                        <div class="img-container span2 small">
                            <img class="overlay-img-container" src="/images/dummy.jpg" alt="dummy"/>
                            <a href="#" class="overlay-delete delete">x</a>
                        </div>
                    <? } ?>
                </div>

            </div>
        </div>
    </div>
</section>
<section id="social-media" class="tab-pane fade">
    <div class="row-fluid">
        <div class="span7">
            <h3>Social Media</h3>

            <div class="row-fluid row-facebook">
                <label for="facebook_msg">Facebook</label>
                <?=$this->Form->input('facebook_msg', array(
                    'div' => false,
                    'placeholder' => 'Facebook message: e.g. Brand the moment #PIXTA')); ?>
                <?=$this->Form->input('facebook_url', array(
                    'div' => false,
                    'class' => 'not_required span12',
                    'placeholder' => 'Facebook link: e.g. www.pixta.com.au')); ?>
            </div>
            <div class="row-fluid">
                <label for="twitter_msg">Twitter</label>
                <?=$this->Form->input('twitter_msg', array(
                    'div' => false,
                    'class' => 'not_required span12',
                    'placeholder' => 'Twitter message: e.g. Brand the moment #PIXTA')); ?>
            </div>
        </div>

    </div>
</section>
<section id="campaign-settings" class="tab-pane fade">
    <div class="row-fluid">
        <div class="span7">
            <h3>Campaign Settings</h3>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span7">
            <div class="row-fluid">
                <label for="html_before">Content Before Upload</label>
                <?=$this->Form->input('html_before', array('div' => false, 'placeholder' => 'http://')); ?>

                <div class="switch pull-right">
                    <input type="radio" checked="checked" id="html_before_on" value="1" name="data[Event][html_before_on]" class="switch-input">
                    <label class="switch-label switch-label-off" for="html_before_on">On</label>
                    <input type="radio" id="html_before_off" value="0" name="data[Event][html_before_on]" class="switch-input">
                    <label class="switch-label switch-label-on" for="html_before_off">Off</label>
                    <span class="switch-selection"></span>
                </div>
            </div>
            <div class="row-fluid">
                <label for="html_after">Content After Upload</label>
                <?=$this->Form->input('html_after', array('div' => false, 'placeholder' => 'http://')); ?>

                <div class="switch pull-right">
                    <input type="radio" checked="checked" id="html_after_on" value="1" name="data[Event][html_after_on]" class="switch-input">
                    <label class="switch-label switch-label-off" for="html_after_on">On</label>
                    <input type="radio" id="html_after_off" value="0" name="data[Event][html_after_on]" class="switch-input">
                    <label class="switch-label switch-label-on" for="html_after_off">Off</label>
                    <span class="switch-selection"></span>
                </div>
            </div>

        </div>
        <div class="span5">
            <aside class="help">
                <div>Please provide links to your
                    mobile friendly web pages to
                    appear before/after the user
                    uploads their photo.
                </div>

                <div>
                    <span class="icon-query pull-right"></span>

                    <div class="hide"><img src='/images/tooltip_img_1.jpg'/></div>

                    Hover here to see exactly
                    how this will appear:
                </div>
            </aside>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span7">
            <div class="row-fluid">
                <label for="t_c">Terms & Conditions</label>
                <?=$this->Form->input('t_c', array('div' => false, 'placeholder' => 'http://')); ?>

                <div class="switch pull-right">
                    <input type="radio" checked="checked" id="t_c_on" value="1" name="data[Event][t_c_on]" class="switch-input">
                    <label class="switch-label switch-label-off" for="t_c_on">On</label>
                    <input type="radio" id="t_c_off" value="0" name="data[Event][t_c_on]" class="switch-input">
                    <label class="switch-label switch-label-on" for="t_c_off">Off</label>
                    <span class="switch-selection"></span>
                </div>
            </div>
        </div>
        <div class="span5">
            <aside class="help">
                <div>Please provide a link to any
                    Terms & Conditions you would
                    like to include with your event.
                </div>

                <div>
                    <span class="icon-query pull-right"></span>
                    <div class="hide"><img src='/images/tooltip_img_2.jpg'/></div>
                    Hover here to see exactly
                    how this will appear:
                </div>
            </aside>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span7">
            <div class="row-fluid">
                <div class="span6">
                    <label>Image Moderation</label>
                </div>
                <div class="span6">
                    <div class="switch pull-right">
                        <input type="radio" checked="checked" id="auto_moderate_on" value="1" name="data[Event][auto_moderate]" class="switch-input">
                        <label class="switch-label switch-label-off" for="auto_moderate_on">On</label>
                        <input type="radio" id="auto_moderate_off" value="0" name="data[Event][auto_moderate]" class="switch-input">
                        <label class="switch-label switch-label-on" for="auto_moderate_off">Off</label>
                        <span class="switch-selection"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="span5">
            <aside class="help no-top-margin">
                Turning image moderation on will require manual approval
                of images before they appear on an event's live picture feed
            </aside>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span7">
            <div class="row-fluid">
                <label for="stage">Event Status</label>
                <? echo $this->Form->select('stage', array('' => '---Select Stage---', 'Scheduled' => 'Scheduled', 'Draft' => 'Draft'), array('div' => false)); ?>
            </div>
            <div class="row-fluid">
                <label for="event_status">Event Order</label>
                <?=$this->Form->input('view_order', array('div' => false, 'placeholder' => 'Event order in number', 'type' => 'text')); ?>
            </div>
        </div>
        <div class="span5">
            <aside class="help">
                Turning image moderation on will require manual approval
                of images before they appear on an event's live picture feed
            </aside>
        </div>
    </div>
</section>
<section id="custom-page" class="tab-pane fade">
    <div class="row-fluid">
        <div class="span7">
            <h3>Custom Page</h3>

            <div class="row-fluid">
                <label for="public_event_name">Public Event Name</label>
                <? echo $this->Form->input('public_event_name', array('label' => false, 'div' => false,'placeholder' => 'Public Event Name', 'class' => 'span12')); ?>

            </div>

            <div class="row-fluid">
                <label for="public_phone_number">Phone Number</label>
                <?=$this->Form->input('public_phone_number', array(
                'div' => false,
                'class' => 'not_required span12',
                'placeholder' => 'Phone Number')); ?>
            </div>
            <div class="row-fluid">
                <label for="public_email">Email</label>
                <?=$this->Form->input('public_email', array(
                'div' => false,
                'class' => 'not_required span12',
                'placeholder' => 'Email')); ?>
            </div>
            <div class="row-fluid">
                <label for="public_description">Public Description</label>
                <?=$this->Form->input('public_description', array(
                'div' => false,
                'placeholder' => 'Public Description')); ?>
            </div>

        </div>

    </div>
</section>
</div>
<section id="decisions">
    <div class="row-fluid">
        <div class="span7">
            <div class="row-fluid">
                <?=$this->Form->end(array('id' => 'submitBtn', 'class' => 'btn btn-large btn-block btn-primary', 'label' => 'Add',))?>
            </div>
        </div>
    </div>
</section>
</div>
<script type="text/javascript" src="/js/jquery.maskedinput.min.js"></script>

<script>
    $(function () {
        $("#EventViewOrder").mask("9?99999",{placeholder:" "});
        window.EventStep = [];
        $('.overlay-img-upload').change(function (e, invoked) {
            if (invoked == 'clear') return;
            var index = $('.overlay-img-upload').index($(this));
            var file = e.target.files !== undefined ? e.target.files[0] : (e.target.value ? { name: e.target.value.replace(/^.+\\/, '') } : null);

            if (!file) {
                this.clear();
                return;
            }

            if ((typeof file.type !== "undefined" ? file.type.match('image.*') : file.name.match(/\.(gif|png|jpe?g)$/i)) && typeof FileReader !== "undefined") {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.overlay-img-container').eq(index).attr('src', e.target.result);
                    if (index == 0) {
                        $('#overlay-img-selected').attr('src', e.target.result);
                    }
                };

                reader.readAsDataURL(file);
            }
        });

        $('.overlay-img-container').click(function () {
            $('#overlay-img-selected').attr('src', $(this).attr('src'));
        });

        $('.overlay-delete').click(function (e) {
            var index = $('.overlay-delete').index($(this));
            $('.overlay-img-upload').eq(index).val('');
            $('.overlay-img-container').eq(index).attr('src', '');
            e.preventDefault();
        });

        function validateTab($tab) {
            if ($tab.attr('id') === 'campaign-settings') return true;

            var isErrorFree = true;
            $tab.find(":input:not(:file):not(input[type=hidden]):not(#EventEventRadius):not(.not_required)").each(function () {
                if (validateElement.isValid(this) == false) {
                    isErrorFree = false;
                }
            });
            return isErrorFree;
        }

        function checkStep(index) {
            // 0 means its in the array
            // -1 means not in array
            var alreadyDone = true;
            if ($.inArray(index, EventStep) === -1 ) {
                EventStep.push(index);
                alreadyDone = false;
            }
            return alreadyDone;
        }

        function allStepsDone() {
            return !!((EventStep.length === 5));
        }

        $('#submitBtn').click(function () {
            var $tabPanes = $('.tab-pane');
            var isValidTab = false;
            var $tab = $('.tab-pane:visible');
            var index = $tabPanes.index($tab);

            function checkAllSteps() {
                $tabPanes.each(function (i) {
                    isValidTab = validateTab($(this));
                    if (isValidTab === false) {
                        $('#event-menu a').eq(i).click();
                        return false;
                    }
                });
                if (isValidTab) {
                    if (index + 1 == $tabPanes.length) {
                        return true;
                    } else {
                        $('#event-menu a').eq(index + 1).click();
                        return false;
                    }
                }
            }

            if ( allStepsDone() ) {
                checkAllSteps();
            } else {
                isValidTab = validateTab($tab);
                //campaign-settings bypass
                if (isValidTab) {
                    checkStep(index);
                    if (index + 1 == $tabPanes.length) {
                        checkAllSteps();
                    } else {
                        $('#event-menu a').eq(index + 1).click();
                    }
                }
                return false;
            }

        });
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#EventPublicAddress').change(function(){
            var geocoder = new google.maps.Geocoder();

            var address = $('#EventPublicAddress').val();
            var location = '';
            geocoder.geocode( { 'address': address}, function(results, status) {

                if (status == google.maps.GeocoderStatus.OK)
                {
                    $('#EventGpslat').val(results[0].geometry.location.lat());
                    $('#EventGpslong').val(results[0].geometry.location.lng());
                }
                else {
                    alert('Address is not right. Please use right adrees to convert.');
                }
            });
        });

        $('#EventHtmlBefore').change(function(){
            if(!url_validation($('#EventHtmlBefore').val())){
                alert('Please add http:// with the url');
                $('#EventHtmlBefore').val('');
            }
        });
        $('#EventHtmlAfter').change(function(){
            if(!url_validation($('#EventHtmlAfter').val())){
                alert('Please add http:// with the url');
                $('#EventHtmlAfter').val('');
            }
        });


        function url_validation(url){
            var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
            if (pattern.test(url)) {
                return true;
            }
            return false;
        }
    });

</script>