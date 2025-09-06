<?php
$query = $dbCon->prepare("SELECT * FROM News 
                            WHERE NewsID = :newsID");
$query->bindParam(':newsID', $newsID);
$query->execute();
$getNewsItem = $query->fetch();


// get everything from news
$queryNews = $dbCon->prepare("SELECT * FROM News");
$queryNews->execute();
$getNewsAdmin = $queryNews->fetchAll();

// Check if ID exists in the URL
if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $currentNewsID = (int) $_GET['ID']; 
} else {
    $currentNewsID = 0; 
}


// get other news
$query = $dbCon->prepare("SELECT * FROM News WHERE NewsID != :currentID ORDER BY DateOfNews DESC LIMIT 3");
$query->bindParam(':currentID', $currentNewsID, PDO::PARAM_INT);
$query->execute();
$getOtherNews = $query->fetchAll(PDO::FETCH_ASSOC);
$queryNews = $dbCon->prepare("SELECT * FROM News ORDER BY DateOfNews DESC LIMIT 1");
$queryNews->execute();
$getFirstNews = $queryNews->fetch(PDO::FETCH_ASSOC);




// get about ghiblifilms from db
$queryAboutCompany = $dbCon->prepare("SELECT NameOfCompany, CompanyDescription 
                                    FROM CompanyInformation");
$queryAboutCompany->execute();
$getAboutCompany = $queryAboutCompany->fetchAll();


// get everything from view with company address info 
$queryCompanyAddressView = $dbCon->prepare("SELECT *
                                            FROM CompanyAddressView");
$queryCompanyAddressView->execute();
$getCompanyAddressView = $queryCompanyAddressView->fetchAll();


// get company information
$queryCompanyInformation = $dbCon->prepare("SELECT C.*, A.StreetName, A.StreetNumber, A.PostalCode, A.Country 
                                            FROM CompanyInformation C 
                                            LEFT JOIN Address A 
                                            ON C.AddressID = A.AddressID");
$queryCompanyInformation->execute();
$getCompanyInformationAdmin = $queryCompanyInformation->fetchAll();


// Get everything from opening hours
$queryOpeningHour = $dbCon->prepare("SELECT * 
                                    FROM OpeningHour");
$queryOpeningHour->execute();
$getOpeningHour = $queryOpeningHour->fetchAll();

// company info
$query = $dbCon->prepare("SELECT * 
                           FROM CompanyInformation");
$query->execute();
$everythingCompany = $query->fetchAll();