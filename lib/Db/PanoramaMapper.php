<?php
/**
 * Analytics
 *
 * SPDX-FileCopyrightText: 2019-2022 Marcel Scherello
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\Analytics\Db;

use OCP\DB\Exception;
use OCP\IDBConnection;
use OCP\IL10N;
use Psr\Log\LoggerInterface;

class PanoramaMapper
{
    private $userId;
    private $l10n;
    private $db;
    private $logger;
    const TABLE_NAME = 'analytics_panorama';

    public function __construct(
        $userId,
        IL10N $l10n,
        IDBConnection $db,
        LoggerInterface $logger
    )
    {
        $this->userId = $userId;
        $this->l10n = $l10n;
        $this->db = $db;
        $this->logger = $logger;
    }

    /**
     * get reports
     * @return array
     * @throws Exception
     */
    public function index()
    {
        $sql = $this->db->getQueryBuilder();
        $sql->from(self::TABLE_NAME)
            ->select('*')
            ->where($sql->expr()->eq('user_id', $sql->createNamedParameter($this->userId)))
            ->orderBy('parent', 'ASC')
            ->addOrderBy('name', 'ASC');
        $statement = $sql->executeQuery();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        return $result;
    }

	/**
	 * get reports for user
	 * @param $userId
	 * @return array
	 * @throws Exception
	 */
	public function indexByUser($userId)
	{
		$sql = $this->db->getQueryBuilder();
		$sql->from(self::TABLE_NAME)
			->select('id')
			->where($sql->expr()->eq('user_id', $sql->createNamedParameter($userId)));
		$statement = $sql->executeQuery();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

	/**
     * create report
     * @param $name
     * @param $type
     * @param $parent
     * @param $pages
     * @return int
     * @throws Exception
     */
    public function create($name, $type, $parent, $pages)
    {
        $sql = $this->db->getQueryBuilder();
        $sql->insert(self::TABLE_NAME)
            ->values([
                'user_id' => $sql->createNamedParameter($this->userId),
                'name' => $sql->createNamedParameter($name),
                'type' => $sql->createNamedParameter($type),
                'parent' => $sql->createNamedParameter($parent),
                'pages' => $sql->createNamedParameter($pages),
            ]);
        $sql->executeStatement();
        return (int)$sql->getLastInsertId();
    }

    /**
     * get single panorama including subpages for user
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function readOwn(int $id)
    {
        $sql = $this->db->getQueryBuilder();
        $sql->from(self::TABLE_NAME)
            ->select('*')
            ->where($sql->expr()->eq('id', $sql->createNamedParameter($id)))
            ->orWhere($sql->expr()->eq('parent', $sql->createNamedParameter($id)))
            ->andWhere($sql->expr()->eq('user_id', $sql->createNamedParameter($this->userId)))
            ->orderBy('name', 'ASC');
        $statement = $sql->executeQuery();
        $result = $statement->fetch();
        $statement->closeCursor();

        return $result;
    }

	/**
	 * get single report
	 * @param int $id
	 * @return array
	 * @throws Exception
	 */
	public function read(int $id)
	{
		$sql = $this->db->getQueryBuilder();
		$sql->from(self::TABLE_NAME)
			->select('*')
			->where($sql->expr()->eq('id', $sql->createNamedParameter($id)));
		$statement = $sql->executeQuery();
		$result = $statement->fetch();
		$statement->closeCursor();

		if ($result !== false) {
			$result['type'] = (int) $result['type'];
			$result['parent'] = (int) $result['parent'];
		}

		return $result;
	}

	/**
     * update report
     * @param $id
     * @param $name
     * @param $type
     * @param $parent
     * @param $pages
     * @return bool
     * @throws Exception
     */
    public function update($id, $name, $type, $parent, $pages)
    {
        $name = $this->truncate($name, 64);
        $sql = $this->db->getQueryBuilder();
        $sql->update(self::TABLE_NAME)
            ->set('name', $sql->createNamedParameter($name))
            ->set('type', $sql->createNamedParameter($type))
            ->set('parent', $sql->createNamedParameter($parent))
            ->set('pages', $sql->createNamedParameter($pages))
            ->where($sql->expr()->eq('user_id', $sql->createNamedParameter($this->userId)))
            ->andWhere($sql->expr()->eq('id', $sql->createNamedParameter($id)));
         $sql->executeStatement();
        return true;
    }

    /**
     * delete report
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delete($id)
    {
        $sql = $this->db->getQueryBuilder();
        $sql->delete(self::TABLE_NAME)
            ->where($sql->expr()->eq('id', $sql->createNamedParameter($id)));
        $sql->executeStatement();
        return true;
    }

    public function updateGroup(int $id, int $groupId)
    {
        $sql = $this->db->getQueryBuilder();
        $sql->update(self::TABLE_NAME)
            ->set('parent', $sql->createNamedParameter($groupId))
            ->where($sql->expr()->eq('user_id', $sql->createNamedParameter($this->userId)))
            ->andWhere($sql->expr()->eq('id', $sql->createNamedParameter($id)));
        $sql->executeStatement();
        return true;
    }

    public function updateName(int $id, string $name): bool
    {
        $name = $this->truncate($name, 64);
        $sql = $this->db->getQueryBuilder();
        $sql->update(self::TABLE_NAME)
            ->set('name', $sql->createNamedParameter($name))
            ->where($sql->expr()->eq('user_id', $sql->createNamedParameter($this->userId)))
            ->andWhere($sql->expr()->eq('id', $sql->createNamedParameter($id)));
        $sql->executeStatement();
        return true;
    }

    /**
     * get panoramas by group
     * @param int $groupId
     * @return array
     * @throws Exception
     */
    public function getPanoramasByGroup(int $groupId): array
    {
        $sql = $this->db->getQueryBuilder();
        $sql->from(self::TABLE_NAME)
            ->select('*')
            ->where($sql->expr()->eq('parent', $sql->createNamedParameter($groupId)));
        $statement = $sql->executeQuery();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        if ($result !== false && is_array($result)) {
            foreach ($result as &$row) {
                $row['type'] = (int) $row['type'];
                $row['parent'] = (int) $row['parent'];
            }
            unset($row);
        }

        return $result;
    }

    /**
     * search reports by search string
     * @param $searchString
     * @return array
     * @throws Exception
     */
    public function search($searchString)
    {
        $sql = $this->db->getQueryBuilder();
        $sql->from(self::TABLE_NAME)
            ->select('id')
            ->addSelect('name')
            ->where($sql->expr()->eq('user_id', $sql->createNamedParameter($this->userId)))
            ->andWhere($sql->expr()->iLike('name', $sql->createNamedParameter('%' . $this->db->escapeLikeParameter($searchString) . '%')))
            ->orderBy('name', 'ASC');
        $statement = $sql->executeQuery();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        return $result;
    }


    /**
     * truncates fiels do DB-field size
     *
     * @param $string
     * @param $length
     * @param $dots
     * @return string
     */
    private function truncate($string, $length, $dots = "...")
    {
        return (strlen($string) > $length) ? mb_strcut($string, 0, $length - strlen($dots)) . $dots : $string;
    }
}