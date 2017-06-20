<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('base/header'); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-search">
                <button type="button" class="btn btn-success btn-sm" onclick="edit('')">新增</button>
            </div>
            <table class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                <tr>
                    <th>检测日期</th>
                    <th>白</th>
                    <th>红</th>
                    <th>板</th>
                    <th>中</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="list_content">
                <?php $this->load->view($this_controller.'/'.$this_controller.'_tb'); ?>
                </tbody>
            </table>
            <div>
                当前<input type="text" class="page-input" onkeypress="pagelist.changePage(event,this)" id="pg_page" maxlength="10" value="1"/>页,
                共<span id="pg_page_count"><?php echo $pages['page_count']?></span>页，
                <span id="pg_count"><?php echo $pages['count']?></span>条记录
                <a href="javascript:pagelist.lastPage();">上一页</a>
                <a href="javascript:pagelist.nextPage();">下一页</a>
            </div>
        </div>
    </div>
<?php $this->load->view('base/list_js'); ?>
    <script type="text/javascript">
        //编辑验证函数
        function edit_authen(){
            var date_check = $("#date_check").authen({err_name:'检测日期',empty:false});
            var white = $("#white").authen({reg:['intege1','decmal'],err_name:'白细胞',empty:false});
            var red = $("#red").authen({reg:['intege1','decmal'],err_name:'红细胞',empty:false});
            var platelet = $("#platelet").authen({reg:['intege1','decmal'],err_name:'血小板',empty:false});
            var neutrophils = $("#neutrophils").authen({reg:['intege1','decmal'],err_name:'中性粒',empty:false});
            var back = date_check && white && red && platelet && neutrophils;
            return back;
        }
    </script>
<?php $this->load->view('base/footer'); ?>