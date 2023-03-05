<?php namespace App\Models\DataBaseModels;



use CodeIgniter\Exceptions\ModelException;
use CodeIgniter\Model;
use App\Models\DataBaseModels\SurveyModel;


class PersonModel extends DatabaseModel {

    private $userID;
    private $surveyModel;
    protected $table = 'Person';
    protected $allowedFields = ['name', 'surname', 'email', 'password'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    /**
     * @uses \App\Models\DataBaseModels\SurveyModel
     * @param null $userID
     */
    public function __construct($dbData) {
        if (!isset($_SESSION['ID'])) {
            $this->userID = null;
        }
        else {
            $this->userID = $_SESSION['ID'];
        }
        parent::__construct($dbData);

        $this->surveyModel = new SurveyModel($dbData);
    }

    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data){
        if(isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }

    private function getUserID() {
        return $this->userID;
    }


    /**
     * get all the survey IDs of this person.
     * @return array
     */
    public function getSurveyIDs() {
        $online = '';
        $az = '';
        $asc = '';
        $closedAsc = '';
        if(isset($_POST['offline']))
        {
            $online= ' AND (S.close <= curdate() OR S.open >= curdate())';
        }

        if(isset($_POST['online']))
        {
            $online = ' AND S.close >= curdate() AND S.open <= curdate()';
        }

        if(isset($_POST['az']))
        {
            $az = ' ORDER BY S.title asc';

            if(isset($_POST['closedAsc']) || isset($_POST['closedDesc'])){

                $az = ' ,S.title asc';
            }
        }

        if(isset($_POST['za']))
        {
            $az = ' ORDER BY S.title desc';

            if(isset($_POST['closedAsc']) || isset($_POST['closedDesc'])){

                $az = ' ,S.title desc';
            }
        }

        if(isset($_POST['asc']))
        {
            $asc = ' ORDER BY open asc';

            if(isset($_POST['za']) || isset($_POST['az']) || isset($_POST['closedAsc']) || isset($_POST['closedDesc'])){
                $asc = ' ,open asc';
            }
        }

        if(isset($_POST['desc']))
        {
            $asc = ' ORDER BY open desc';

            if(isset($_POST['za']) || isset($_POST['az']) || isset($_POST['closedAsc']) || isset($_POST['closedDesc'])){
                $asc = ' ,open desc';
            }
        }

        if(isset($_POST['closedAsc']))
        {
            $closedAsc = ' And S.close <= curdate() ORDER BY S.close asc';

        }

        if(isset($_POST['closedDesc']))
        {
            $closedAsc = ' And S.close <= curdate() ORDER BY S.close desc';
        }
        $querySurveyIDs = 'SELECT S.idSurvey
                            FROM Survey2 AS S, PersonHasSurvey as PHS
                            WHERE S.idSurvey = PHS.surveyId
                        AND PHS.personId = :userID:';
        $querySurveyIDs = $querySurveyIDs.$online.$closedAsc.$az.$asc;
        $this->db->transStart();
        $surveyIDs = $this->db->query($querySurveyIDs, ['userID' => $this->getUserID()]);
        $this->error_check();
        $this->db->transComplete();
        $result = [];
        foreach ($surveyIDs->getResult() as $row) {
            array_push($result, [$row->idSurvey]);
        }
        return $result;
    }


    /**
     * Get user name and surname based on its id.
     */
    public function getUserInfo() {
        $queryUserinfo = 'SELECT P.name, P.surname
                            FROM Person AS P
                            WHERE P.ID = :userID:';
        $this->db->transStart();
        $userInfo = $this->db->query($queryUserinfo, ['userID' => $this->getUserID()]);
        $this->error_check();
        $this->db->transComplete();
        $result = [];

        $result['name'] = $userInfo->getResult()[0]->name;
        $result['surname'] = $userInfo->getResult()[0]->surname;
        return $result;
    }

}