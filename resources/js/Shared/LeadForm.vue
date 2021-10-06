<template>
  <form @submit.prevent="handleSubmit">
    <div class="row">
      <div class="col-md-10">
      <div class="form-group row">
        <label
          for="immatriculation"
          class="col-md-4 col-form-label text-md-right"
        >Immatriculation</label
        >
        <div class="col-md-6">
          <input
            id="immatriculation"
            v-model="lead.immatriculation"
            type="text"
            class="form-control "
            tabindex="1"
          />
        </div>
      </div>
      <div class="form-group row">
        <label
          for="hcnumber"
          class="col-md-4 col-form-label text-md-right"
        >Hc Number</label
        >
        <div class="col-md-6">
          <input
            id="hcnumber"
            v-model="lead.hcnumber"
            type="text"
            class="form-control "
            tabindex="2"
          />
        </div>
      </div>
      <div class="form-group row">
        <label
          for="marque"
          class="col-md-4 col-form-label text-md-right"
        >Marque</label
        >
        <div class="col-md-6">
          <input
            id="marque"
            v-model="lead.marque"
            class="form-control "
            tabindex="3"
            type="text"
          />
        </div>
      </div>
      <div class="form-group row">
        <label
          for="chassisNumber"
          class="col-md-4 col-form-label text-md-right"
        >Numero chassis</label>
        <div class="col-md-6">
          <input
            id="chassisNumber"
            v-model="lead.chassisNumber"
            type="text"
            class="form-control"
            tabindex="4"
          />
        </div>
      </div>
      <div class="form-group row">
        <label
          for="transportCabine"
          class="col-md-4 col-form-label text-md-right"
        >transportCabine</label
        >
        <div class="col-md-6">
          <input
            id="transportCabine"
            v-model="lead.transportCabine"
            type="text"
            class="form-control "
            tabindex="5"
          />
        </div>
      </div>
      <div class="form-group row">
        <label
          for="username"
          class="col-md-4 col-form-label text-md-right">
          Costotian
        </label>
        <div class="col-md-6">
          <input
            id="username"
            v-model="lead.username"
            type="text"
            tabindex="6"
            class="form-control " />
        </div>
      </div>
      <div class="form-group row">
        <label
          for="dateAchat"
          class="col-md-4 col-form-label text-md-right"
        >Date d'achat</label>
        <div class="col-md-6">
          <input
            type="date"
            id="dateAchat"
            tabindex="7"
            v-model="lead.dateAchat"
            class="form-control"
          >
        </div>
      </div>

      <div class="card-body-divider"></div>
      <div class="form-group row">
        <label
          for="Assurance "
          class="col-md-4 col-form-label text-md-right">
          Assurance :
        </label>
        <div class="col-md-3">
          <input
            type="date"
            id="assurance"
            v-model="lead.assuranceD"
            tabindex="8"
            placeholder="date creation"
            class="form-control">
        </div>
        <div class="col-md-3">
          <input
            type="date"
            v-model="lead.assuranceF"
            tabindex="9"
            placeholder="date d'expiration"
            class="form-control">
        </div>
      </div>

      <div class="form-group row">
        <label
          for="Carte grise"
          class="col-md-4 col-form-label text-md-right">
          Carte grise :
        </label>
        <div class="col-md-3">
          <input
            type="date"
            v-model="lead.cartegriseD"
            placeholder="date creation"
            tabindex="10"
            class="form-control">
        </div>
        <div class="col-md-3">
          <input
            type="date"
            v-model="lead.cartegriseF"
            placeholder="date d'expiration"
            tabindex="11"
            class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label
          for="Visite technique"
          class="col-md-4 col-form-label text-md-right">
          Visite technique:
        </label>
        <div class="col-md-3">
          <input
            type="date"
            v-model="lead.visitetechniqueD"
            placeholder="date creation"
            tabindex="12"
            class="form-control">
        </div>
        <div class="col-md-3">
          <input
            type="date"
            tabindex="13"
            v-model="lead.visitetechniqueF"
            placeholder="date d'expiration"
            class="form-control">
        </div>

        <div class="col-md-1">
          <button class="btn btn-success">Save</button>
        </div>
        <div class="col-md-1">
          <inertia-link class="btn btn-warning" :href="$route('lead.list')">Back</inertia-link>
        </div>
      </div>
    </div>
    </div>
  </form>
</template>

<script>
export default {
  props: {
    mainLead: Object,
    packages: Array
  },
  data() {
    return {
      lead: {
        immatriculation:"",
        hcnumber: "",
        marque :"",
        chassisNumber: "",
        username: "",
        transportCabine: "",
        dateAchat: "",
        assuranceD: "",
        assuranceF: "",
        cartegriseD: "",
        cartegriseF: "",
        visitetechniqueD: "",
        visitetechniqueF: "",
      }
    };
  },
  created() {
    this.lead = this.mainLead;
  },
  methods: {
    handleSubmit() {
      this.$emit("formSubmit", this.lead);
    },
    optionIsSelected(optionName, packageName) {
      console.log(optionName === packageName);
      return optionName === packageName;
    }
  }
};
</script>
