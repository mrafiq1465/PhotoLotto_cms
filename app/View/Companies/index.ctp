<section class="list">
    <?=$this->element('menu', array(
    "heading" => "Manage Companies"
));?>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Details</th>
            <th>Edit</th>
            <th>Delete</th>            
        </tr>
        </thead>
        <tbody>
        <? foreach ($companies as $k => $company) { ?>
        <tr class="<?=($k % 2 == 0) ? 'odd' : 'even'?>">
            <td class="name span8"><?php echo $company['Company']['name'];  ?> </td>
            <td>
                <?=$this->Html->link('<i class="icon-pencil"></i> ', '/companies/edit/' . $company['Company']['id'], array('class' => '', 'escape' => FALSE)); ?>
            </td>
            <td>
                <?=$this->Html->link('<i class="icon-trash"></i> ', '/companies/delete/' . $company['Company']['id'], array('class' => 'del-btn', 'item_name'=> $company['Company']['name'], 'escape' => FALSE)); ?>
            </td>
        </tr>
            <? } ?>
        <tr>
            <td colspan="3" style="text-align: right;">
                <a href="/companies/export">Export All</a>
            </td>
        </tr>
        </tbody>
    </table>
</section>
