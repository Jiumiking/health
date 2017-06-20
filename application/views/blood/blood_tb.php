<?php if(!empty($data)){ ?>
    <?php foreach($data as $info){ ?>
        <tr>
            <td><?php echo $info['date_check']; ?></td>
            <td><?php echo $info['white']; ?></td>
            <td><?php echo $info['red']; ?></td>
            <td><?php echo $info['platelet']; ?></td>
            <td><?php echo $info['neutrophils']; ?></td>
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
        <td colspan="6">未找到有效数据</td>
    </tr>
<?php } ?>