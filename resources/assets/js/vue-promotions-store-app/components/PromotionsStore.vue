<template>
  <div class="container-fluid">
    <div class="card" id="form-promotion">
        <div class="card-header bg-dark text-light">
            <h1><icon-app icon-image="gift"></icon-app> Alta de promociones</h1>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-9">
                        <form @submit.prevent="sendNewPromotion">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-desc-tab" data-toggle="pill" href="#pills-desc" role="tab" aria-controls="pills-desc" aria-selected="true">Descripción</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-type-tab" data-toggle="pill" href="#pills-type" role="tab" aria-controls="pills-type" aria-selected="false">Tipo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-vigencia-tab" data-toggle="pill" href="#pills-vigencia" role="tab" aria-controls="pills-vigencia" aria-selected="false">Vigencia</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-estado-tab" data-toggle="pill" href="#pills-estado" role="tab" aria-controls="pills-estado" aria-selected="false">Estado</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-terms-tab" data-toggle="pill" href="#pills-terms" role="tab" aria-controls="pills-terms" aria-selected="false">Terminos y condiciones</a>
                                </li>
                            </ul>
                            <hr>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-desc" role="tabpanel" aria-labelledby="pills-desc-tab">
                                    <fieldset>
                                        <legend class="text-muted">Datos descriptivos</legend>
                                        <div class="form-group">
                                            <label for="namePromotion" class="sr-only">Nombre de la promoción</label>
                                            <input type="text" id="namePromotion" class="form-control" placeholder="Nombre de la promoción" v-model="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="descProm" class="sr-only">Descripción</label>
                                            <markdown-editor
                                                    id="descProm"
                                                    v-model="description"
                                                    ref="markdownEditor"
                                                    preview-class="markdown-body"></markdown-editor>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="tab-pane fade" id="pills-type" role="tabpanel" aria-labelledby="pills-type-tab">
                                    <fieldset>
                                        <legend class="text-muted">Tipo de promoción</legend>
                                        <btn-switch-app :init-left="isLeft"
                                                        text-left="Porcentaje"
                                                        text-right="Monto fijo"
                                                        icon-left="porcent"
                                                        icon-right="dollar"></btn-switch-app>
                                        <transition name="inputs-type-transition"
                                                    enter-active-class="animated bounceInUp"
                                                    leave-active-class="animated bounceOutUp">
                                            <div class="form-label-group" v-if="isLeft" key="percentaje">
                                                <input type="number" class="form-control" id="porcentPromotion" placeholder="Porcentaje de promoción" min="1" max="100" step="0.01" pattern="^[0-9]+" v-model="percent">
                                                <label for="porcentPromotion">Porcentaje de promoción</label>
                                            </div>
                                            <div class="form-label-group" v-else key="amount">
                                                <input type="number" id="montoPromotion" class="form-control" placeholder="Monto fijo de promoción" min="1" step="0.01" pattern="^[0-9]+" v-model="amount">
                                                <label for="montoPromotion">Monto fijo de promoción</label>
                                            </div>
                                        </transition>
                                    </fieldset>
                                </div>
                                <div class="tab-pane fade" id="pills-vigencia" role="tabpanel" aria-labelledby="pills-vigencia-tab">
                                    <fieldset>
                                        <legend class="text-muted">Vigencia</legend>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="dateFrom" class="sr-only">Desde</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Desde</span>
                                                        </div>
                                                        <date-picker id="dateFrom" v-model="dateFrom" :config="config" placeholder="Ingrese la fecha de inicio"></date-picker>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="dateTo" class="sr-only">Hasta</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Hasta</span>
                                                        </div>
                                                        <date-picker id="dateTo" v-model="dateTo" :config="config" placeholder="Ingrese la fecha de finalización"></date-picker>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-12 justify-content-center">
                                            <transition name="invalid-promotion-date"
                                                enter-active-class="animated rubberBand"
                                                leave-active-class="animated bounceOutRight">
                                                <div class="alert alert-warning text-center" v-if="invalidDate">
                                                    <small> <icon-app icon-image="exclamation-triangle"></icon-app> La fecha <i>"desde"</i> o de inicio no puede ser menor a la fecha <i>"hasta"</i> o de finalización.</small>
                                                </div>
                                            </transition>
                                          </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="tab-pane fade" id="pills-estado" role="tabpanel" aria-labelledby="pills-estado-tab">
                                    <fieldset>
                                        <legend class="text-muted">Estado de la promoción</legend>
                                        <div class="form-group">
                                            <label for="estadoProm" class="sr-only">Estado</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Estado</div>
                                                </div>
                                                <select id="estadoProm" class="form-control" v-model="state">
                                                  <option value="disabled">Deshabilitada</option>
                                                  <option value="enabled">Habilitada</option>
                                                  <option value="paused">Pausada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="stateDesc">Descripción del estado</label>
                                            <markdown-editor
                                                    id="stateDesc"
                                                    v-model="descState"
                                                    ref="markdownEditor"
                                                    preview-class="markdown-body"></markdown-editor>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="tab-pane fade" id="pills-terms" role="tabpnale" aria-labelledby="pills-terms-tab">
                                    <fieldset>
                                        <legend class="text-muted">Términos y condiciones</legend>
                                        <div class="form-group">
                                            <label for="termsAndConditions" class="sr-only">Términos y condiciones</label>
                                            <div class="form-group">
                                                <markdown-editor
                                                        id="termsAndconditions"
                                                        v-model="terms"
                                                        ref="markdownEditor"
                                                        preview-class="markdown-body"></markdown-editor>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-12">
                              <div class="alert alert-info text-center">
                                <small>
                                  <icon-app icon-image="info-circle"></icon-app> Recuerde que toda promoción debe cumplir con las exigencias de las leyes civil, comercial y de defensa del consumidor de la Republica Argentina. Si no está seguro por favor consulte con abogado antes de poner en vigencia una promoción.
                                </small>
                              </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-outline-success" :disabled="hasErrors">Crear <icon-app icon-image="gift"></icon-app></button>
                                <button type="reset" class="btn btn-outline-warning">Limpiar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
    import VueNoti from 'vue-notifications'
    import Icon from '../../vue-commons/components/Icon'
    import BtnSwitch from '../../vue-commons/components/BtnSwitch'
    import markdownEditor from 'vue-simplemde/src/markdown-editor'
    import datePicker from 'vue-bootstrap-datetimepicker'
    import { mapActions } from 'vuex';

    export default {
        name: 'promotions-create',
        components: {
            'icon-app': Icon,
            'btn-switch-app': BtnSwitch,
            markdownEditor,
            datePicker
        },
        data() {
            return {
                isLeft: true,
                name: '',
                description: '',
                state: 'disabled',
                descState: '',
                terms: '',
                percent: null,
                amount: null,
                dateFrom: null,
                dateTo: null,
                config: {
                    locale: 'es',
                    format: 'DD/MM/YYYY',
                    minDate: new Date(moment().year(), moment().month(), moment().date(), 0, 0, 0, 0)
                }
            }
        },
        computed: {
          invalidDate () {
              let dateFrom = this.dateFrom ? moment(this.dateFrom, 'DD/MM/YYYY') : null;
              let dateTo = this.dateTo ? moment(this.dateTo, 'DD/MM/YYYY') : null;

              if (dateFrom && dateTo) {
                  return dateFrom.isAfter(dateTo);
              } else {
                return true;
              }
          },
          positiveNumber () {
            if (+this.percent < 0) {
              this.percent = -(+this.percent);
            }
            if (+this.amount < 0) {
              this.amount = -(+this.amount);
            }
          },
          hasErrors () {
            return !this.name || !this.terms || (!this.percent && !this.amount) || this.invalidDate
          }
        },
        methods: {
            sendNewPromotion() {
              this.createNewPromotion({
                name: this.name,
                amount: this.amount,
                percentage: this.percent,
                description: this.description,
                startDate: this.dateFrom,
                endDate: this.dateTo,
                state: this.state,
                descriptionState: this.descState,
                termsAndConditions: this.terms
              }).then(response => {
                VueNoti.success(response);
              }).catch(error => {
                VueNoti.error(error);
              })
            },
            ...mapActions('auth', ['fireSetTokenMutation']),
            ...mapActions('promotion_store', ['createNewPromotion'])
        },
        filters: {},
        created() {
        },
        mounted() {
            if (this.$cookies.isKey('info_one')) {
                this.fireSetTokenMutation(this.$cookies.get('info_one'));
            }
            window.EventBus.$on('change-side', (side) => this.isLeft = side);
        }
    }
</script>

<style scoped>
  @import '~eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css';
  @import '~simplemde/dist/simplemde.min.css';
  @import '~github-markdown-css';

  .CodeMirror, .CodeMirror-scroll {
    height: 400px;
  }
</style>
