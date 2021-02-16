<div class="container">
    <?php if (app()->session->hasFlash('success')): ?>
    <p class="has-text-success">
        <?= app()->session->getFlash('success'); ?>
    </p>
    <?php endif; ?>
    <form method="post" action="/signup">
        <div class="field">
            <label class="label">Full name</label>
            <div class="control">
                <input class="input" type="text" name="name" value="<?= old('name'); ?>">
            </div>
            <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['name'][0]; ?>
            </p>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Username</label>
            <div class="control">
                <input class="input" type="text" name="username" value="<?= old('username'); ?>">
            </div>
            <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['username'][0]; ?>
            </p>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" name="email" value="<?= old('email'); ?>">
            </div>
            <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['email'][0]; ?>
            </p>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" name="password">
            </div>
            <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['password'][0]; ?>
            </p>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Confirm password</label>
            <div class="control">
                <input class="input" type="password" name="password_confirmation">
            </div>
            <?php if (app()->session->hasFlash('errors')): ?>
            <p class="has-text-danger">
                <?= app()->session->getFlash('errors')['password_confirmation'][0]; ?>
            </p>
            <?php endif; ?>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-link">Submit</button>
            </div>
        </div>
    </form>

</div>