<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>

<style>
	.login {
		margin: 1% 5% 1% 55%;
		padding: 50px;
	}
</style>

<div class="main_div mb-5">
	<div class="row">
		<div class="col-md-12 mx-auto">

			<div class="row mt-5">
			<div class="col-md-7">
			<div class="textHeading">
			<p>What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been </p>
</div>
			</div>

				<div class="col-md-4">
                <?=$message?>
					<div class="card rounded-0 p-5 py-4 ml-4 mr-4">
						<div class="text-center m-3">
							<h3>Reginster Here</h3>
						</div>
						<form action="<?=base_url('signUpSave')?>" method="post">

                        <div class="form-group">
								<!-- <label>Name</label> -->
								<input type="text" name="name" placeholder="Name" class="form-control rounded-0">
                                <div class="text-danger"><?=$error['name']?></div>
							</div>

							<div class="form-group">
								<!-- <label>Email/Username</label> -->
							<input type="text" name="email" placeholder="Email/Username" class="form-control rounded-0">
							<div class="text-danger"><?=$error['email']?></div>
                            </div>
							<div class="form-group">
								<!-- <label>Password</label> -->
								<input type="password" name="password" placeholder="Password" class="form-control rounded-0">
                                <div class="text-danger"><?=$error['password']?></div>
                            </div>

                            <div class="form-group">
								<!-- <label>Conform Password</label> -->
								<input type="password" name="conform_password" placeholder="Conform Password" class="form-control rounded-0">
                                <div class="text-danger"><?=$error['conform_password']?></div>
                            </div>

							<div class="form-group text-center">
								<input type="submit" value="Register" class="btn btn-success btn-sm rounded-0 w-75">
							</div>
							<div>
							<span>
							
							</span>
							<span class="float-right">
							<a href="<?=base_url('/')?>" class="text primary">Sign In</a>
							</span>
							</div>
						</form>
					</div>
				</div>
</div class='col-md-1'></div>
			</div>


		</div>
	</div>
</div>

<?= $this->endSection() ?>