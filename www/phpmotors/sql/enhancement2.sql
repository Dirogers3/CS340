-- part 1
INSERT INTO clients (clientFirstname, clientLastName, clientEmail, clientPassword, comment) VALUES ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "I am the real Ironman");

-- part 2
UPDATE clients SET clientLevel = 3 WHERE clientEmail = "tony@starkent.com";

-- part 3
UPDATE inventory SET invDescription = REPLACE( invDescription, "small interior", "spacious interior") WHERE invMake = "GM" AND invModel = "Hummer";

-- part 4
SELECT * FROM inventory AS inventory LEFT JOIN carclassification AS classification ON inventory.classificationId = classification.classificationId WHERE classification.classificationName = "SUV";

-- part 5
DELETE FROM inventory where invModel= "Wrangler" AND invMake = "Jeep";

-- part 6
UPDATE inventory SET invImage = CONCAT('/phpmotors', invImage), invThumbnail = CONCAT('/phpmotors', invThumbnail);



