<div class="list">
    <table>
        <? foreach ($companies as $k => $company) { ?>
        <tr class="<?=($k % 2 == 0) ? 'odd' : 'even'?>">
            <td class="name"><?php echo $company['Company']['name'];  ?> </td>
            <td>
                <?php echo $this->Html->link('Edit', '/companies/edit/' . $company['Company']['id'], array('class' => '')); ?>
            </td>
            <td>
                <?php echo $this->Html->link('Delete', '/companies/delete/' . $company['Company']['id'], array('class' => '')); ?>
            </td>
        </tr>
        <? } ?>
    </table>
</div>