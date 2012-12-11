<section class="list">
    <?=$this->element('menu', array(
    "heading" => "Event Report"
));?>


    <section id="form-container">
        <ul>
            <li>Event name:</li>
            <li>Start date: <input name="data[Event][date_start]" type="date"  value="Today" /></li>
            <li>End date: <input name="data[Event][date_end]" type="date"  value="Today" /></li>
        </ul>
    </section>
</section>


