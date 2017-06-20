<div class="panel panel-default">
    <div class="panel-heading">
        <h2>编辑</h2>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" name="edit_form" id="edit_form" action="<?php echo site_url($this_controller.'/my_edit_do');?>" method="post">
            <input type="hidden" name="id" value="<?php echo empty($data['id'])?'':$data['id']; ?>">
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">开始日期</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="date_start" id="date_start" value="<?php echo empty($data['date_start'])?'':$data['date_start']; ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:true})">
                    <span class="error-block" id="m_date_start"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">结束日期</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="date_end" id="date_end" value="<?php echo empty($data['date_end'])?'':$data['date_end']; ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:true})">
                    <span class="error-block" id="m_date_end"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">治疗类型</label>
                <div class="col-lg-10 col-md-10">
                    <select name="type" id="type" class="form-control">
                        <option value="1">感染</option>
                        <option value="2">升白</option>
                        <option value="3">输血</option>
                        <option value="4">输板</option>
                        <option value="5">化疗</option>
                        <option value="6">开刀</option>
                        <option value="7">放疗</option>
                        <option value="8">移植</option>
                        <option value="9">其他</option>
                    </select>
                    <span class="error-block" id="m_type"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">名称</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo empty($data['name'])?'':$data['name']; ?>" placeholder="治疗别名">
                    <span class="error-block" id="m_name"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">备注</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="remark" id="remark" value="<?php echo empty($data['remark'])?'':$data['remark']; ?>" placeholder="请输入备注">
                    <span class="error-block" id="m_remark"></span>
                </div>
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <input type="button" class="btn btn-sm btn-success" value="确认" onclick="edit_do()">
        <input type="button" class="btn btn-sm btn-danger" value="返回" onclick="back()">
    </div>
</div>