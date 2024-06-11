<?php
class Album
{
    /** @var int|null Het ID van het album */
    private ?int $id;
    /** @var string De naam van het album */
    private string $Naam;
    /** @var string De artiesten van het album */
    private string $Artiesten;
    /** @var string|null De releasedatum van het album */
    private ?string $Release_Datum;
    /** @var string|null De URL van het album */
    private ?string $URL;
    /** @var string|null De afbeeldingen van het album */
    private ?string $Afbeeldingen;
    /** @var string|null De prijs van het album */
    private ?string $Prijs;
    /**
     * @param int|null $id
     * @param string $Naam
     * @param string $Artiesten
     * @param string|null $Release_Datum
     * @param string|null $URL
     * @param string|null $Afbeeldingen
     * @param string|null $Prijs
     */
    public function __construct(?int $id, string $Naam, string $Artiesten, ?string $Release_Datum, ?string $URL, ?string $Afbeeldingen, ?string $Prijs)
    {
        $this->id = $id;
        $this->Naam = $Naam;
        $this->Artiesten = $Artiesten;
        $this->Release_Datum = $Release_Datum;
        $this->URL = $URL;
        $this->Afbeeldingen = $Afbeeldingen;
        $this->Prijs = $Prijs;
    }
    /**
     * Haal alle albums op uit de database.
     *
     * @param PDO $db De PDO-databaseverbinding.
     * @return array Een array van Album objecten.
     */
    public static function getAll(PDO $db): array
    {
// Voorbereiden van de query
        $stmt = $db->query("SELECT * FROM album");
// Array om albums op te slaan
        $albums = [];
// Itereren over de resultaten en albums toevoegen aan de array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album(
                $row['ID'],
                $row['Naam'],
                $row['Artiesten'],
                $row['Release_datum'],
                $row['URL'],
                $row['Afbeelding'],
                $row['Prijs']
            );
            $albums[] = $album;
        }
// Retourneer array met albums
        return $albums;
    }
    /**
     * Zoek albums op basis van id.
     *
     * @param PDO $db De PDO-databaseverbinding.
     * @param int $id Het unieke ID van een album waarnaar we zoeken.
     * @return Album|null Het gevonden Album-object of null als er geen overeenkomstig album werd gevonden.
     */
    public static function findById(PDO $db, int $id): ?Album
    {
// Voorbereiden van de query
        $stmt = $db->prepare("SELECT * FROM album WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
// Retourneer een album als gevonden, anders null
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new Album(
                $row['id'],
                $row['Naam'],
                $row['Artiesten'],
                $row['Release_Datum'],
                $row['URL'],
                $row['Afbeeldingen'],
                $row['Prijs']
            );
        } else {
            return null;
        }
    }
    /**
     * Zoek albums op basis van naam.
     *
     * @param PDO $db De PDO-databaseverbinding.
     * @param string $naam De naam om op te zoeken.
     * @return array Een array van Album objecten die aan de zoekcriteria voldoen.
     */
    public static function findByNaam(PDO $db, string $naam): array
    {
// Zet de naam eerst om naar lowercase letters
        $naam = strtolower($naam);
// Voorbereiden van de query
        $stmt = $db->prepare("SELECT * FROM album WHERE LOWER(Naam) LIKE :naam");
// Voeg wildcard toe aan de naam
        $naam = "%$naam%";
// Bind de naam aan de query en voer deze uit
        $stmt->bindParam(':naam', $naam);
        $stmt->execute();
// Array om albums op te slaan
        $albums = [];
// Itereren over de resultaten en albums toevoegen aan de array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $albums[] = new Album(
                $row['id'],
                $row['Naam'],
                $row['Artiesten'],
                $row['Release_Datum'],
                $row['URL'],
                $row['Afbeeldingen'],
                $row['Prijs']
            );
        }
// Retourneer array met albums
        return $albums;
    }
    /**
     * Methode om een nieuw album toe te voegen aan de database.
     *
     * @param PDO $db De PDO-databaseverbinding.
     */
    public function save(PDO $db): void
    {
// Voorbereiden van de query
        $stmt = $db->prepare("INSERT INTO album (Naam, Artiesten, Release_Datum, URL, Afbeelding, Prijs) VALUES (:Naam, :Artiesten, :Release_Datum, :URL, :Afbeeldingen, :Prijs)");
        $stmt->bindParam(':Naam', $this->Naam);
        $stmt->bindParam(':Artiesten', $this->Artiesten);
        $stmt->bindParam(':Release_Datum', $this->Release_Datum);
        $stmt->bindParam(':URL', $this->URL);
        $stmt->bindParam(':Afbeeldingen', $this->Afbeeldingen);
        $stmt->bindParam(':Prijs', $this->Prijs);
        $stmt->execute();
    }
    /**
     * Methode om een bestaand album bij te werken op basis van ID.
     *
     * @param PDO $db De PDO-databaseverbinding.
     */
    public function update(PDO $db): void
    {
// Voorbereiden van de query
        $stmt = $db->prepare("UPDATE album SET Naam = :Naam, Artiesten = :Artiesten, Release_Datum = :Release_Datum, URL = :URL, Afbeelding = :Afbeelding, Prijs = :Prijs WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':Naam', $this->Naam);
        $stmt->bindParam(':Artiesten', $this->Artiesten);
        $stmt->bindParam(':Release_Datum', $this->Release_Datum);
        $stmt->bindParam(':URL', $this->URL);
        $stmt->bindParam(':Afbeeldingen', $this->Afbeeldingen);
        $stmt->bindParam(':Prijs', $this->Prijs);
        $stmt->execute();
    }
// Getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNaam(): string
    {
        return $this->Naam;
    }
    public function getArtiesten(): string
    {
        return $this->Artiesten;
    }
    public function getRelease_Datum(): ?string
    {
        return $this->Release_Datum;
    }
    public function getURL(): ?string
    {
        return $this->URL;
    }
    public function getAfbeeldingen(): ?string
    {
        return $this->Afbeeldingen;
    }
    public function getPrijs(): ?string
    {
        return $this->Prijs;
    }
// Setters
    public function setNaam(string $Naam): void
    {
        $this->Naam = $Naam;
    }
    public function setArtiesten(string $Artiesten): void
    {
        $this->Artiesten = $Artiesten;
    }
    public function setRelease_Datum(?string $Release_Datum): void
    {
        $this->Release_Datum = $Release_Datum;
    }
    public function setURL(?string $URL): void
    {
        $this->URL = $URL;
    }
    public function setAfbeelding(?string $Afbeelding): void
    {
        $this->Afbeeldingen = $Afbeelding;
    }
    public function setPrijs(?string $Prijs): void
    {
        $this->Prijs = $Prijs;
    }
}