<?php if(!empty($data)){ ?>
    <?php foreach($data as $info){ ?>
        <tr>
            <td><?php echo $info['date_start'].'</br>'.$info['date_end']; ?></td>
            <td><?php echo $info['name']; ?></td>
            <td><?php echo empty($treatment_status[$info['type']])?'':$treatment_status[$info['type']]; ?></td>
            <td><?php echo $info['remark']; ?></td>
            <td>
                <button type="button" class="btn btn-primary btn-xs" title="编辑" onclick="edit('<?php echo $info['id'];?>')" >
                    <i class="fa fa-edit "></i>
                </button>
                <button type="button" class="btn btn-danger btn-xs" title="删除" onclick="del('<?php echo $info['id'];?>')" >
                    <i class="fa fa-trash-o "></i>
                </button>
            </td>
        </tr>
    <?php } ?>
<?php }else{ ?>
    <tr>
        <td colspan="5">未找到有效数据</td>
    </tr>
<?php } ?>