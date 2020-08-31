<?php $__env->startSection('content'); ?>
<div class="container " style="height: 100%" >
    <div class="row justify-content-center align-items-center " style="height: 100%">
        <div class="col-md-5">
            <div class="card ">
                <h3 class="card-header text-center shadow pt-3 pb-3">Akeed groups</h3>

                <div class="card-body mt-4">
                    <form method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            

                            <div class="col-md-9 mx-auto">
                                <input id="email" type="email" placeholder="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            

                            <div class="col-md-9 mx-auto">
                                <input id="password" placeholder="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember">
                                        <?php echo e(__('Remember Me')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn text-white btn-login col-md-8 offset-md-2">
                                    <?php echo e(__('Login')); ?>

                                </button>
                                
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-2">
                            <div class="col-md-7 mx-auto ">
                                <a class="btn btn-link " href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Forgot Your Password?')); ?>

                                </a>
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<style>
.shadow{
    box-shadow: 5px 5px;
    background-color: white;
}
.btn-login{
    background: rgb(255,131,61);
background: linear-gradient(90deg, rgba(255,131,61,1) 0%, rgba(249,75,126,1) 100%);
}
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>