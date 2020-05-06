<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Counterup Item')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Conterup Items')); ?></h4>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <?php $a=0; ?>
                            <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $countu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($a == 0): ?> active <?php endif; ?>"  data-toggle="tab" href="#slider_tab_<?php echo e($key); ?>" role="tab" aria-controls="home" aria-selected="true"><?php echo e(get_language_by_slug($key)); ?></a>
                                </li>
                                <?php $a++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            <?php $b=0; ?>
                            <?php $__currentLoopData = $all_counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $counterup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($b == 0): ?> show active <?php endif; ?>" id="slider_tab_<?php echo e($key); ?>" role="tabpanel" >
                                    <table class="table table-default">
                                        <thead>
                                        <th><?php echo e(__('ID')); ?></th>
                                        <th><?php echo e(__('Icon')); ?></th>
                                        <th><?php echo e(__('Number')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Extra Text')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $counterup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($data->id); ?></td>
                                                <td><i class="<?php echo e($data->icon); ?>"></i></td>
                                                <td><?php echo e($data->number); ?></td>
                                                <td><?php echo e($data->title); ?></td>
                                                <td><?php echo e($data->extra_text); ?></td>
                                                <td>
                                                    <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                       role="button"
                                                       data-toggle="popover"
                                                       data-trigger="focus"
                                                       data-html="true"
                                                       title=""
                                                       data-content="
                                               <h6>Are you sure to delete this counterup item ?</h6>
                                               <form method='post' action='<?php echo e(route('admin.counterup.delete',$data->id)); ?>'>
                                               <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
                                               <br>
                                                <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                </form>
                                                ">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#counterup_item_edit_modal"
                                                       class="btn btn-lg btn-primary btn-sm mb-3 mr-1 counterup_edit_btn"
                                                       data-id="<?php echo e($data->id); ?>"
                                                       data-action="<?php echo e(route('admin.counterup.update')); ?>"
                                                       data-title="<?php echo e($data->title); ?>"
                                                       data-number="<?php echo e($data->number); ?>"
                                                       data-lang="<?php echo e($data->lang); ?>"
                                                       data-icon="<?php echo e($data->icon); ?>"
                                                       data-extra="<?php echo e($data->extra_text); ?>"
                                                    >
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php $b++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('New Counterup')); ?></h4>
                        <form action="<?php echo e(route('admin.counterup')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="language"><h6><strong><?php echo e(__('Languages')); ?></strong></h6></label>
                                <select name="lang" id="language" class="form-control">
                                    <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($data->slug); ?>"><?php echo e($data->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <small><?php echo e(__("select language for make this text multilingual")); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="title"><?php echo e(__('Title')); ?></label>
                                <input type="text" class="form-control"  id="title"  name="title" placeholder="<?php echo e(__('Title')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="icon" class="d-block"><?php echo e(__('Icon')); ?></label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon" value="fas fa-exclamation-triangle" name="icon">
                            </div>
                            <div class="form-group">
                                <label for="number"><?php echo e(__('Number')); ?></label>
                                <input type="text" class="form-control"  id="number"  name="number" placeholder="<?php echo e(__('Number')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="extra_text"><?php echo e(__('Extra Text')); ?></label>
                                <input type="text" class="form-control"  id="extra_text"  name="extra_text" placeholder="<?php echo e(__('Extra Text')); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add  New Counterup')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="counterup_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Edit Counterup Item')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="#" id="counterup_edit_modal_form"  method="post">
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" id="counterup_id" value="">
                        <div class="form-group">
                            <label for="edi_language"><h6><strong><?php echo e(__('Languages')); ?></strong></h6></label>
                            <select name="lang" id="edit_language" class="form-control">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->slug); ?>"><?php echo e($data->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small><?php echo e(__("select language for make this text multilingual")); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="edit_title"><?php echo e(__('Title')); ?></label>
                            <input type="text" class="form-control"  id="edit_title" name="title" placeholder="<?php echo e(__('Title')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon" class="d-block"><?php echo e(__('Icon')); ?></label>
                            <div class="btn-group ">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control"  id="edit_icon" value="fas fa-exclamation-triangle" name="icon">
                        </div>
                        <div class="form-group">
                            <label for="edit_number"><?php echo e(__('Number')); ?></label>
                            <input type="text" class="form-control"  id="edit_number"  name="number" placeholder="<?php echo e(__('Number')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="edit_extra_text"><?php echo e(__('Extra Text')); ?></label>
                            <input type="text" class="form-control"  id="edit_extra_text"  name="extra_text" placeholder="<?php echo e(__('Extra Text')); ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save Changes')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $(document).on('click','.counterup_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var number = el.data('number');
                var action = el.data('action');
                var icon = el.data('icon');
                var extra = el.data('extra');
                var form = $('#counterup_edit_modal_form');
                form.attr('action',action);
                form.find('#counterup_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_number').val(number);
                form.find('#edit_extra_text').val(extra);
                form.find('#edit_language option[value='+el.data("lang")+']').attr('selected',true);//lang
                form.find('.icp-dd').attr('data-selected',el.data('icon'));
                form.find('.iconpicker-component i').attr('class',el.data('icon'));
            });
            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/bizzcox/@core/resources/views/backend/pages/counterup.blade.php ENDPATH**/ ?>