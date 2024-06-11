<?php
class Nummer
{
    private ?int $ID;
    private string $AlbumID;
    private string $Title;
    private ?string $Duur;
    private ?string $URL;

    public function __construct(?int $ID, string $AlbumID, string $Title, ?string $Duur, ?string $URL)
    {
        $this->ID = $ID;
        $this->AlbumID = $AlbumID;
        $this->Title = $Title;
        $this->Duur = $Duur;
        $this->URL = $URL;
    }

    public static function getAll(PDO $db): array
    {
        $stmt = $db->query("SELECT * FROM Nummer");
        $nummers = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nummers[] = new self(
                $row['ID'],
                $row['AlbumID'],
                $row['Title'],
                $row['Duur'],
                $row['URL']
            );
        }
        return $nummers;
    }

    public static function findById(PDO $db, int $id): ?self
    {
        $stmt = $db->prepare("SELECT * FROM Nummer WHERE ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new self(
                $row['ID'],
                $row['AlbumID'],
                $row['Title'],
                $row['Duur'],
                $row['URL']
            );
        } else {
            return null;
        }
    }

    public static function findByNaam(PDO $db, string $naam): array
    {
        $naam = strtolower($naam);
        $stmt = $db->prepare("SELECT * FROM Nummer WHERE LOWER(AlbumID) LIKE :naam");
        $naam = "%$naam%";
        $stmt->bindParam(':naam', $naam);
        $stmt->execute();
        $nummers = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $nummers[] = new self(
                $row['ID'],
                $row['AlbumID'],
                $row['Title'],
                $row['Duur'],
                $row['URL']
            );
        }
        return $nummers;
    }

    public function save(PDO $db): void
    {
        $stmt = $db->prepare("INSERT INTO Nummer (AlbumID, Title, Duur, URL) VALUES (:AlbumID, :Title, :Duur, :URL)");
        $stmt->bindParam(':AlbumID', $this->AlbumID);
        $stmt->bindParam(':Title', $this->Title);
        $stmt->bindParam(':Duur', $this->Duur);
        $stmt->bindParam(':URL', $this->URL);
        $stmt->execute();
    }

    public function update(PDO $db): void
    {
        $stmt = $db->prepare("UPDATE Nummer SET AlbumID = :AlbumID, Title = :Title, Duur = :Duur, URL = :URL WHERE ID = :id");
        $stmt->bindParam(':id', $this->ID);
        $stmt->bindParam(':AlbumID', $this->AlbumID);
        $stmt->bindParam(':Title', $this->Title);
        $stmt->bindParam(':Duur', $this->Duur);
        $stmt->bindParam(':URL', $this->URL);
        $stmt->execute();
    }

    public function getID(): ?int
    {
        return $this->ID;
    }

    public function getAlbumID(): string
    {
        return $this->AlbumID;
    }

    public function getTitle(): string
    {
        return $this->Title;
    }

    public function getDuur(): ?string
    {
        return $this->Duur;
    }

    public function getURL(): ?string
    {
        return $this->URL;
    }

    public function setAlbumID(string $AlbumID): void
    {
        $this->AlbumID = $AlbumID;
    }

    public function setTitle(string $Title): void
    {
        $this->Title = $Title;
    }

    public function setDuur(?string $Duur): void
    {
        $this->Duur = $Duur;
    }

    public function setURL(?string $URL): void
    {
        $this->URL = $URL;
    }
}
