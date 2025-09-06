<?php require_once("controllers/companyController.php"); ?>

<section>
    <div class="grid grid-cols-2">
        <div class="contact-left-img"></div>

        <div class="contact container">
            <div>
                <div class="grid flex-col grid-cols-2 gap-4 contact-right">
                    <div>
                        <h1>Contact us</h1>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div>
                            <?php foreach ($everythingCompany as $companyInfo): ?>
                                <p class="flex items-center gap-2 font-extralight"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper-heart" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v1.133l.941.502A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765L2 3.133zm0 2.267-.47.25A1 1 0 0 0 1 5.4v.817l1 .6zm1 3.15 3.75 2.25L8 8.917l1.25.75L13 7.417V2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm11-.6 1-.6V5.4a1 1 0 0 0-.53-.882L14 4.267zM8 2.982C9.664 1.309 13.825 4.236 8 8 2.175 4.236 6.336 1.31 8 2.982m7 4.401-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734Z"/>
                                    </svg><?php echo htmlspecialchars(trim($companyInfo['CompanyEmail'])); ?></p>
                                <p class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                                    </svg><?php echo htmlspecialchars(trim($companyInfo['CompanyPhoneNumber'])); ?></p>
                            <?php endforeach; ?>
                        </div>

                        <div class="opening-hour-time">
                            <?php foreach ($getOpeningHour as $openingHour): ?>
                                <p><?php echo htmlspecialchars(trim($openingHour['Day'])); ?>: <?php echo htmlspecialchars(trim($openingHour['Time'])); ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
    
                    
                </div>

            </div>

            <div>
                <!-- contact form  -->
                <?php include ("modules/contactform/form.php"); ?>
            </div>

        </div>
    </div>
</section>