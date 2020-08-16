 
<?php $__env->startSection('content'); ?>


<?php if(session()->has('message1')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message1'); ?></div> 
<?php endif; ?>
<?php if(session()->has('message2')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message2')); ?></div> 
<?php endif; ?>
<?php if(session()->has('message3')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message3')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-2">
             <?php
                                 function printCompanyName($company){
                                    if($company == "hygiene"){
                                        return "akeed hygiene";
                                    }else if($company == "sweet"){
                                        return "akeed sweet";
                                    }else if ($company == "goods"){
                                        return "akeed food";
                                    }else if($company == "hafko"){
                                        return "akeed factory";
                                    }else if($company == "sanfora"){
                                        return "bruxelle salon";
                                    }else if($company == "service"){
                                        return "akeed trading";
                                    }
                                }
                            ?>
            <div class="card">
                <div class="card-header"><?php echo e(trans('file.dashboard')); ?></div>
                <div class="card-body pt-0">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <?php
                     $user_role_id = Auth::user()->role_id;
                     $number_of_companies = count($companies);
                     if($number_of_companies == 1){
                         $redirectTo = $companies[0]->name;
                     }
                    ?>
                    <?php if($number_of_companies == 1): ?>
                        
                    <input type="hidden" name="redirect" id="redirect" value=<?php echo e($redirectTo); ?>>
                    <?php endif; ?>
                    <div class="container">
                        <?php for($i = 0 ; $i< count($companies) ; $i += 2 ): ?>
                            <div class="row">
                                <div class="card col-12 col-md-5 m-3"  >
                                    <a href=<?php echo e(url($companies[$i]->name)); ?>>
                                        <div class="card-body">
                                        <p class="card-text text-center"> <?php echo e(printCompanyName($companies[$i]->name)); ?> </p>
                                        </div>
                                        <img class="card-img-top pb-3" src=<?= "images/".$companies[$i]->name.".png"?> alt="Card image cap">
                                    </a>
                                </div>
                                <?php if( count($companies) > $i +1 ): ?>
                                    <div class="card col-12 col-md-5 m-3"  >
                                        <a href=<?php echo e($companies[$i+1]->name); ?>>
                                            <div class="card-body">
                                            <p class="card-text text-center"> <?php echo e(printCompanyName($companies[$i+1]->name)); ?> </p>
                                            </div>
                                            <img class="card-img-top pb-3" src=<?= "images/".$companies[$i+1]->name.".png"?> alt="Card image cap">
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<script>
    document.addEventListener('DOMContentLoaded',()=>{
        let redirectTo = document.querySelector('#redirect').value;
        let url = "https://www.akeedgroups.com/"+redirectTo;
        window.location.assign(url);
    })
</script>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>