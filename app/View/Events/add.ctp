<div id="secondary" class="pull-left">
    <h2>Campaign Creator</h2>
    <nav id="event-menu">
        <ul>
            <li class="active"><a href="#event_details">Event Details</a></li>
            <li><a href="#overlay_images">Overlay Images</a></li>
            <li><a href="#social-media">Social Media</a></li>
            <li><a href="#campaign-settings">Campaign Settings </a></li>
        </ul>
    </nav>
</div>
<div id="primary">
<div class="tab-content" id="event_tabs">
<section id="event_details" class="tab-pane fade in active">
    <div class="row-fluid">
        <div class="span7">
            <h3>Event Details</h3>

            <div class="row-fluid row-event-name">
                <label for="event_name">Event Name <span>(60 characters max.)</span></label>
                <input class="span12" placeholder="Event Name" name="event_name" id="event_name"
                       type="text" />
            </div>

            <div class="row-fluid">
                <label for="event_description1">Event Description <span>(60 characters max. per line)</span></label>
                <input class="span12" placeholder="Description 1: e.g. Brand the moment!"
                       name="event_description" id="event_description1" type="text" />
                <input class="span12" placeholder="Description 2: e.g. #PIXTA" name="event_description"
                       id="event_description2" type="text" />
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <label for="event_description1">Event/Company Logo <span>(100kb max.)</span></label>

                    <div class="row-fluid">
                        <div class="span7">
                            <input class="span12" placeholder="Description 1: e.g. Brand the moment!"
                                   name="event_description" id="event_description11" type="text" />
                        </div>
                        <div class="span5">
                            <input class="span12" placeholder="Description 2: e.g. #PIXTA"
                                   name="event_description" id="event_description21" type="text" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="span5">
            <img src="/images/iphone.jpg" alt="iPhone" />
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
                <label for="start_date">Start Date</label>
                <input class="span12" placeholder="Please choose a start date" name="start_date"
                       id="start_date"
                       type="date" />
            </div>
            <div class="row-fluid">
                <label for="end_date">End Date</label>
                <input class="span12" placeholder="Please choose a end date" name="end_date" id="end_date"
                       type="date" />
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
                <label for="address">Address</label>
                <input class="span12" placeholder="e.g. 38/110 Bourke Rd, Alexandria, NSW, 2015" type="text"
                       name="address" id="address" />
            </div>
            <div class="row-fluid">
                <label for="latitude">Latitude</label>
                <input class="span12" placeholder="e.g. -33.887072" type="text" name="latitude"
                       id="latitude" />
            </div>
            <div class="row-fluid">
                <label for="longitude">Longitude</label>
                <input class="span12" placeholder="e.g. 151.20741999999996" type="text" name="longitude"
                       id="longitude" />
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <div class="span7">
                            <label for="event_type">Event Type</label>
                            <select class="span12" name="event_type" id="event_type">
                                <option value="option1">Some Option1</option>
                                <option value="option2">Some Option2</option>
                                <option value="option3">Some Option3</option>
                            </select>
                        </div>
                        <div class="span5">
                            <label for="event_radius">Radius <span>(in kilometres)</span></label>
                            <input class="span12" id="event_radius" placeholder="5" name="event_radius"
                                   type="text" />
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

            <div class="row-fluid"><input id="EventImgOverlay1" name="data[Event][img_overlay_1]"
                                          type="file" /></div>
            <div class="row-fluid"><input id="EventImgOverlay2" name="data[Event][img_overlay_2]"
                                          type="file" /></div>
            <div class="row-fluid"><input id="EventImgOverlay3" name="data[Event][img_overlay_3]"
                                          type="file" /></div>
            <div class="row-fluid"><input id="EventImgOverlay4" name="data[Event][img_overlay_4]"
                                          type="file" /></div>
            <div class="row-fluid"><input id="EventImgOverlay5" name="data[Event][img_overlay_5]"
                                          type="file" /></div>

            <div class="row-fluid row-upload">
                <button class="btn primary">Upload</button>
            </div>

        </div>
        <div class="span7">
            <div class="row-fluid">
                <div class="img-container span12 big">
                    <img src="/images/dummy.jpg" alt="dummy" />
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="img-container span2 small">
                        <img src="/images/dummy.jpg" alt="dummy" /><a href="#" class="delete">x</a></div>
                    <div class="img-container span2 small">
                        <img src="/images/dummy.jpg" alt="dummy" /><a href="#" class="delete">x</a></div>
                    <div class="img-container span2 small">
                        <img src="/images/dummy.jpg" alt="dummy" /><a href="#" class="delete">x</a></div>
                    <div class="img-container span2 small">
                        <img src="/images/dummy.jpg" alt="dummy" /><a href="#" class="delete">x</a></div>
                    <div class="img-container span2 small">
                        <img src="/images/dummy.jpg" alt="dummy" /><a href="#" class="delete">x</a></div>
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
                <label for="facebook_message">Facebook</label>
                <input class="span12" id="facebook_message" name="facebook_message"
                       placeholder="Facebook message: e.g. Brand the moment #PIXTA" type="text" />
                <input class="span12" id="facebook_link" name="facebook_name"
                       placeholder="Facebook link: e.g. www.pixta.com.au" type="text" />
            </div>
            <div class="row-fluid">
                <label for="twitter_message">Twitter</label>
                <input class="span12" id="twitter_message" name="twitter_message"
                       placeholder="Twitter message: e.g. Brand the moment #PIXTA" type="text" />
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
                <label for="content_before_upload">Content Before Upload</label>
                <input class="span12" type="text" name="content_before_upload" id="content_before_upload"
                       placeholder="http://" />

                <div class="switch pull-right">
                    <input type="radio" id="html_before_on" value="1" name="data[Event][html_before_on]" class="switch-input">
                    <label class="switch-label switch-label-off" for="html_before_on">On</label>
                    <input type="radio" checked="checked" id="html_before_off" value="0" name="data[Event][html_before_on]" class="switch-input">
                    <label class="switch-label switch-label-on" for="html_before_off">Off</label>
                    <span class="switch-selection"></span>
                </div>
            </div>
            <div class="row-fluid">
                <label for="content_after_upload">Content After Upload</label>
                <input class="span12" type="text" name="content_after_upload" id="content_after_upload"
                       placeholder="http://" />

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
                    Hover here to see exactly
                    how this will appear:
                </div>
            </aside>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span7">
            <div class="row-fluid">
                <label for="EventTC">Terms & Conditions</label>
                <input class="span12" type="text" name="data[Event][t_c]" id="EventTC" placeholder="http://" />

                <div class="switch pull-right">
                    <input type="radio" checked="checked" id="t_c_on" value="1" name="data[Event][t_c_on]" class="switch-input">
                    <label class="switch-label switch-label-off" for="t_c_on">On</label>
                    <input type="radio" id="t_c_off" value="0" name="data[Event][t_c_off]" class="switch-input">
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
                <label for="event_status">Event Status</label>
                <select class="span12" name="event_status" id="event_status">
                    <option value="01">Schd01</option>
                    <option value="02">Schd02</option>
                </select>
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
</div>
<section id="decisions">
    <div class="row-fluid">
        <div class="span7">
            <div class="row-fluid">
                <button class="btn btn-large btn-block btn-primary" type="button">Save</button>
            </div>
        </div>
    </div>
</section>
</div>