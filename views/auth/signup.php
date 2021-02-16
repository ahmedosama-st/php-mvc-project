<div class="container">
    <form method="post" action="/signup">
        <div class="field">
            <label class="label">Full name</label>
            <div class="control">
                <input class="input" type="text" name="name">
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
                <input class="input" type="text" name="username">
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
                <input class="input" type="email" name="email">
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