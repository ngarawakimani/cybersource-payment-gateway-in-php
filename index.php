   <!DOCTYPE html>
    <html>
      <head>
        <title>Bootstrap 101 Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
      </head>
      <body>
        
        <div class="container">
          <div class="row" style="margin-top: 100px">
            <div class="col-md-10 col-md-offset-1">
              <form method="POST" action="Sale.php">
                 
                <div class="col-md-6">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fname">First name</label>
                        <input type="text" class="form-control" name="fname" placeholder="First name">
                      </div>
                    </div>
                    <div class="col-md-6">  
                      <div class="form-group">
                        <label for="lname">Last name</label>
                        <input type="text" class="form-control" name="lname" placeholder="Last name">
                      </div>
                    </div>
                  <div class="form-group">
                    <label for="State">State</label>
                    <input type="text" class="form-control" name="state" placeholder="State">
                  </div>
                  <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" class="form-control" name="street" placeholder="Street">
                  </div>
                  <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" placeholder="City">
                  </div>
                  <div class="form-group">
                    <label for="postalcode">Postal Code</label>
                    <input type="text" class="form-control" name="postalcode" placeholder="Postal Code">
                  </div>
                  <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" name="country" placeholder="Country">
                  </div>
                </div>  
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="account">Account number</label>
                    <input type="text" class="form-control" name="account" placeholder="Account number">
                  </div>
                  <div class="form-group">
                    <label for="expiration">Expiration month</label>
                    <input type="text" class="form-control" name="expiration" placeholder="Expiration month">
                  </div>
                  <div class="form-group">
                    <label for="expirationyear">Expiration year</label>
                    <input type="text" class="form-control" name="expirationyear" placeholder="Expiration year">
                  </div>
                  <div class="form-group">
                    <label for="currency">Currency</label>
                    <input type="text" class="form-control" name="currency" placeholder="Currency">
                  </div>
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" name="amount" placeholder="Amount">
                  </div>
                </div> 
                <div class="col-md-6 col-md-offset-3" style="margin-top: 50px"> 
                  <button type="submit" class="btn btn-block btn-primary">Submit</button>
                </div>  
              </form>
            </div>
          </div>
        </div>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
      </body>
    </html> 