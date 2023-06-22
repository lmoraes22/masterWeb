<template>
  <div class="login">
    <div class="d-flex justify-content-center p-4">
      <div class="card d-flex justify-content-center p-4 rounded-3" style="width: 30rem; background-color: #F8F8FF;">
        <div class="card">
          <div class="card-body py-5 px-md-5">
            <form>
              <div class="form-outline mb-4">
                <input type="email" id="form3Example3" class="form-control">
                <label class="form-label" for="form3Example3" style="margin-left: 0px;">Endereço de Email</label>
                <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 88.8px;"></div><div class="form-notch-trailing"></div></div></div>
              <div class="form-outline mb-4">
                <input type="password" id="form3Example4" class="form-control">
                <label class="form-label" for="form3Example4" style="margin-left: 0px;">Senha</label>
                <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 64.8px;"></div><div class="form-notch-trailing"></div></div>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Login',
}
</script>
