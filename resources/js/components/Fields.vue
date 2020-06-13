<template>
    <div class="mt-5">
       <div class="card mb-5">
            <div class="card-header">
              <span class="lead" >Форма обратной связи для записи на показ системы iFORA</span>
            </div>
            <div class="card-body">
                 <div class="form-group">
                    <label for="name">Фaмилия</label>
                    <input type="text" id="name" v-bind:class="{ 'is-invalid': nameHasError }" class="form-control form-control-lg " placeholder="Фамилия" v-model="name">
                </div>

                 <div class="form-group">
                    <label for="fName">Имя</label>
                    <input type="text" id="fName" v-bind:class="{ 'is-invalid': fNameHasError }" class="form-control form-control-lg" placeholder="Имя" v-model="fName">
                </div>

                 <div class="form-group">
                    <label for="sName">Отчество</label>
                    <input type="text" id="sName" v-bind:class="{ 'is-invalid': sNameHasError }" class="form-control form-control-lg" placeholder="Отчество" v-model="sName">
                </div>

                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" id="phone" v-bind:class="{ 'is-invalid': phoneHasError }" class="form-control form-control-lg" placeholder="телефон в формате +x xxx xxx xx xx, пример: +7 926 123 45 67"  v-model="phone">
                </div>

                 <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" v-bind:class="{ 'is-invalid': emailHasError }" class="form-control form-control-lg" placeholder="Email"  v-model="email">
                </div>

                <div class="form-group">
                    <label for="picker">Выберите желаемую дату и время показа</label>
                    <input type="text" id="picker" v-bind:class="{ 'is-invalid': dateTimeHasError }" class="form-control form-control-lg"  v-model="dateTime">
                </div>

                <div class="alert alert-danger" v-for="warning in warnings">
                    {{ warning }}
                </div>

                <button v-on:click = "checkData" v-bind:class="{ 'd-none': submitBtnHidden }" class="btn btn-danger">Отправить заявку</button>
                <div v-bind:class="{ 'd-none': successMessageHidden }" class="alert  alert-success">
                    {{ successMessage }}
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                fName: '',
                sName: '',
                phone: '',
                email: '',
                dateTime: '',
                warnings: [],
                isActive: 'd-none',
                nameHasError: false,
                nameHasError: false,
                fNameHasError: false,
                sNameHasError: false,
                phoneHasError: false,
                emailHasError: false,
                dateTimeHasError: false,
                submitBtnHidden: false,
                successMessage: '',
                successMessageHidden: true
            }
        },

        methods: {
            succsess: function() {
                
                this.isActive = 
                this.name = 
                this.phone = 
                this.message = '';

                let that = this;
                setTimeout(function(){
                    that.isActive = 'd-none';
                }, 4000);
            }, 

            checkPhone: function() {
                /**
                * Ориентировано на российские мобильные + городские с кодом из 3 цифр (например, Москва).
                * Зеленый свет для:
                *    +79261234567
                *    89261234567
                *    79261234567
                *    +7 926 123 45 67
                *    8(926)123-45-67
                *    123-45-67
                *    9068702
                *    9261234567
                *    79261234567
                *    (495)1234567
                *    (495) 123 45 67
                *    89261234567
                *    8-926-123-45-67
                *    8 927 1234 234
                *    8 927 12 12 888
                *    8 927 12 555 12
                *    8 927 123 8 123
                */
                let re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
                let valid = re.test(this.phone);
                if (!valid) {
                    this.warnings.push('введите телефон в формате +7 xxx xxx xx xx');
                    this.phoneHasError = true;
                }
            },

            checkEmail: function() {
                /**
                 * Email Regex (RFC 5322 Official Standard)
                 * https://emailregex.com/email-validation-summary/
                 */
                let re = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
                let valid = re.test(this.email);
                if (!valid) {
                    this.warnings.push('введите корректный email');
                    this.emailHasError = true;
                }
            },

            emptinessCheck: function(field, name, className) {
                if (field == '') {
                    this.warnings.push('поле ' + name + ' не может быть пустым');
                    this.setErrorStatus(name);
                }
            },

            setErrorStatus: function(name) {
                switch(name) {
                    case '"Фамилия"':
                        this.nameHasError = true;
                        break;
                    case '"Имя"':
                        this.fNameHasError = true;
                        break;
                    case '"Отчество"':
                        this.sNameHasError = true;
                        break;
                    case '"Датa и время показа"':
                        this.dateTimeHasError = true;
                }
            },

            unsetErrorStatus: function(name) {
                this.nameHasError =
                this.nameHasError =
                this.fNameHasError =
                this.sNameHasError =
                this.phoneHasError =
                this.emailHasError =
                this.dateTimeHasError = false;
            },

            getValues: function() {
               this.name = document.getElementById("name").value;
               this.fName = document.getElementById("fName").value;
               this.sName = document.getElementById("sName").value;
               this.phone = document.getElementById("phone").value;
               this.email = document.getElementById("email").value;
               this.dateTime = document.getElementById("picker").value;
            },

            successReport: function() {
                this.submitBtnHidden = true;
                this.successMessage =  `${this.fName} ${this.sName}, cпасибо за заявку. Мы свяжемся с Вами в ближайшее время.`;
                this.successMessageHidden = false;
            },

            checkData: function() {
                this.warnings = [];
                this.unsetErrorStatus();
                this.getValues();
                
                this.emptinessCheck(this.name, '"Фамилия"', this.nameHasError);
                this.emptinessCheck(this.fName, '"Имя"', this.fNameHasError);
                this.emptinessCheck(this.sName, '"Отчество"', this.sNameHasError);
                this.emptinessCheck(this.dateTime, '"Датa и время показа"', this.dateTimeHasError);
                this.checkPhone();
                this.checkEmail();

                if (this.warnings.length == 0) {
                   this.successReport();
                   this.sendData();
                }
            },

            sendData: function () {
                let hr = new XMLHttpRequest();
                let that = this;
                let url = "/save";
                let vars = "name=" +  this.name + 
                            "&fname=" + this.fName + 
                            "&sname=" + this.sName + 
                            "&phone=" + this.phone + 
                            "&email=" + this.email + 
                            "&show_date=" + this.dateTime;

                hr.open("POST", url, true);
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                hr.setRequestHeader('X-CSRF-TOKEN', window.Laravel.csrfToken);
                hr.onreadystatechange = function() {
                    let return_data = hr.responseText;
                    if(hr.readyState == 4 && hr.status == 200) {
                        if (return_data == 'done') {
                            console.log(return_data);
                        } else {
                            console.log(return_data);
                            that.warnings.push('проблемы на сервере обратитесь к администрору!');
                            that.successMessageHidden = true;
                        }
                    }
                }
                hr.send(vars);
            },
        }
    }
</script>

