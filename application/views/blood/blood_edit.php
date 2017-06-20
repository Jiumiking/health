<div class="panel panel-default">
    <div class="panel-heading">
        <h2>编辑</h2>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" name="edit_form" id="edit_form" action="<?php echo site_url($this_controller.'/my_edit_do');?>" method="post">
            <input type="hidden" name="id" value="<?php echo empty($data['id'])?'':$data['id']; ?>">
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">检测日期</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="date_check" id="date_check" value="<?php echo empty($data['date_check'])?'':$data['date_check']; ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:true})">
                    <span class="error-block" id="m_date_check"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">白细胞</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="white" id="white" value="<?php echo empty($data['white'])?'':$data['white']; ?>" placeholder="单位:10^9/L  参考范围:4.0-15.0">
                    <span class="error-block" id="m_white"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">红细胞</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="red" id="red" value="<?php echo empty($data['red'])?'':$data['red']; ?>" placeholder="单位:10^12/L  参考范围:3.70-5.80">
                    <span class="error-block" id="m_red"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">血小板</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="platelet" id="platelet" value="<?php echo empty($data['platelet'])?'':$data['platelet']; ?>" placeholder="单位:10^9/L  参考范围:100-550">
                    <span class="error-block" id="m_platelet"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">中性粒</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="neutrophils" id="neutrophils" value="<?php echo empty($data['neutrophils'])?'':$data['neutrophils']; ?>" placeholder="单位:10^9/L  参考范围:2.4-4.0">
                    <span class="error-block" id="m_neutrophils"></span>
                </div>
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <input type="button" class="btn btn-sm btn-success" value="确认" onclick="edit_do()">
        <input type="button" class="btn btn-sm btn-danger" value="返回" onclick="back()">
    </div>
</div>