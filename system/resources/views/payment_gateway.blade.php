<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://js.yoco.com/sdk/v1/yoco-sdk-web.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      
    <script>var paymentToken = "A";</script>
</head>
<div class="container">
    <div class="py-5 text-center">
        <h2>Checkout form</h2>
       
      </div>
      <div>
        <label style = "margin-left:80px; font-size: larger;" ><b>Event Name : {{$event}}</b></label>
     
        <label style = "margin-left:500px; font-size: larger;"><b> Price : {{$price}} </b></label>
      
      </div>
  <br>
    <form id="payment-form" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="one-liner">
          <div class="container">
                <div id="card-frame">
                <!-- Yoco Inline form will be added here -->
              </div>
          </div>
          <br/>
          <div class="d-flex justify-content-center">
              <button class="btn btn-primary" id="pay-button">
                  PAY ZAR {{$price}}
              </button>
          </div>
        </div>
    </form>
    <div class="d-flex justify-content-center">
          <p class="success-payment-message" ></p>
          <div id="returnMessage"></div>
          
    </div>
</div>
  <script>
    // Replace the supplied `publicKey` with your own.
    // Ensure that in production you use a production public_key.
    var sdk = new window.YocoSDK({
      publicKey: 'pk_test_e41e5efcbVJwJyGd7254'
    });
  
    // Create a new dropin form instance
    var inline = sdk.inline({
      layout: 'basic',
      amountInCents: {{$price}},
      currency: 'ZAR'
    });
    // this ID matches the id of the element we created earlier.
    inline.mount('#card-frame');
  </script>
  <script>
    // Run our code when your form is submitted
    var form = document.getElementById('payment-form');
    var submitButton = document.getElementById('pay-button');
    form.addEventListener('submit', function (event) {
      event.preventDefault()
      // Disable the button to prevent multiple clicks while processing
      submitButton.disabled = true;
      // This is the inline object we created earlier with the sdk
      inline.createToken().then(function (result) {
       
        // Re-enable button now that request is complete
        // (i.e. on success, on error and when auth is cancelled)
        submitButton.disabled = false;
        if (result.error) {
       
          const errorMessage = result.error.message;
        //   var e = document.getElementById("returnMessage");
          document.getElementById("returnMessage").innerHTML = "<p>error occured: " + errorMessage + "</p>";
        } else {
         
          const token = result;
        //   var e = document.getElementById("returnMessage");
          document.getElementById("returnMessage").innerHTML = "<p>" + token.id + "</p>";
          paymentToken = token.id;
          price={{$price}};
          // ChargeAPI(token.id, {{$price}});
          SaveAPI(token.id,price);
        }
      }).catch(function (error) {
       
        // Re-enable button now that request is complete
        submitButton.disabled = false;
        document.getElementById("returnMessage").innerHTML = "<p>error occured: " + error + "</p>";
      });
    });
  
    // function ChargeAPI(tokenid, amountInCents) {
    //   const SECRET_KEY = "sk_test_4ec2a1adNo4J4pP1cdd468bb5e1c";
    //   axios.post('https://online.yoco.com/v1/charges/', {
    //     "token": tokenid,
    //     "amountInCents": amountInCents,
    //     "currency": "ZAR"
    //   }, {
    //     "X-Auth-Secret-Key" : SECRET_KEY,
    //     "User-Agent" : "4rizon"
    //     // "Content-Type" : "application/json",
    //     // 'Access-Control-Allow-Origin': '*', 
    //     // 'Access-Control-Allow-Methods': 'GET,PUT,POST,DELETE,PATCH,OPTIONS', 
    //     // 'Access-Control-Allow-Headers': 'append,delete,entries,foreach,get,has,keys,set,values,Authorization', 
    //     // 'Origin': 'https://4rizon.com',
       
    //   })
    //   .then(function (response) {
    //     alert(response);
    //   })
    //   .catch(function (error) {
    //     console.log(error);
    //   });
    // }
    function SaveAPI(tokenid,price) {
      var token = tokenid;
      var price = price;
      console.log(token);
          $.ajax({
            type: "POST",
            url: 'https://4rizon.com/api/payment_gateway2',
            data: {token,price},
            success: function(response) {
            console.log(response);
            }
          })
    
    }
    // Any additional form data you want to submit to your backend should be done here, or in another event listener
  </script> 