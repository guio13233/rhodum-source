-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2024 at 03:41 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rhodum`
--
CREATE DATABASE IF NOT EXISTS `rhodum` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `rhodum`;

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
CREATE TABLE IF NOT EXISTS `badges` (
  `id` int NOT NULL,
  `uid` int NOT NULL DEFAULT '0',
  `badgeId` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `badhashes`
--

DROP TABLE IF EXISTS `badhashes`;
CREATE TABLE IF NOT EXISTS `badhashes` (
  `id` int NOT NULL,
  `hash` varchar(1024) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banlogs`
--

DROP TABLE IF EXISTS `banlogs`;
CREATE TABLE IF NOT EXISTS `banlogs` (
  `id` int NOT NULL,
  `banned_by_uid` int NOT NULL DEFAULT '0',
  `banned_by_uname` varchar(50) DEFAULT NULL,
  `banned_uid` int NOT NULL DEFAULT '0',
  `banned_uname` varchar(50) DEFAULT NULL,
  `reason` varchar(512) DEFAULT NULL,
  `bantype` int NOT NULL DEFAULT '0',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogposts`
--

DROP TABLE IF EXISTS `blogposts`;
CREATE TABLE IF NOT EXISTS `blogposts` (
  `id` int NOT NULL,
  `poster_uid` int DEFAULT '0',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(64) DEFAULT NULL,
  `content` varchar(30000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

DROP TABLE IF EXISTS `catagories`;
CREATE TABLE IF NOT EXISTS `catagories` (
  `id` int UNSIGNED NOT NULL,
  `visible` int UNSIGNED NOT NULL DEFAULT '0',
  `developer` int UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

DROP TABLE IF EXISTS `catalog`;
CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int NOT NULL,
  `price` int NOT NULL DEFAULT '0',
  `currencyType` int NOT NULL DEFAULT '0',
  `creator_uid` int NOT NULL DEFAULT '0',
  `buyable` int NOT NULL DEFAULT '1',
  `assetid` int DEFAULT NULL,
  `deleted` int DEFAULT '0',
  `approved` int DEFAULT '0',
  `declined` int DEFAULT '0',
  `rbxasset` int DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `fileHash` varchar(512) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `datafile` varchar(50) DEFAULT NULL,
  `createDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `imgTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `rarity` int NOT NULL DEFAULT '0',
  `stock` varchar(100) NOT NULL DEFAULT 'inf'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `charactercolors`
--

DROP TABLE IF EXISTS `charactercolors`;
CREATE TABLE IF NOT EXISTS `charactercolors` (
  `id` int NOT NULL,
  `uid` int DEFAULT '0',
  `color` int DEFAULT '0',
  `type` varchar(50) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_members`
--

DROP TABLE IF EXISTS `chat_members`;
CREATE TABLE IF NOT EXISTS `chat_members` (
  `id` int NOT NULL,
  `chat_id` int NOT NULL DEFAULT '0',
  `userId` int NOT NULL DEFAULT '0',
  `rank` int NOT NULL DEFAULT '0',
  `lastActive` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastType` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
CREATE TABLE IF NOT EXISTS `chat_messages` (
  `id` int NOT NULL,
  `chat_id` int DEFAULT '0',
  `userId` int DEFAULT '0',
  `message` varchar(65000) DEFAULT NULL,
  `date` int DEFAULT '0',
  `bot` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_sessions`
--

DROP TABLE IF EXISTS `chat_sessions`;
CREATE TABLE IF NOT EXISTS `chat_sessions` (
  `id` int NOT NULL,
  `chatName` varchar(50) NOT NULL DEFAULT '128',
  `chatImage` varchar(50) NOT NULL DEFAULT '128',
  `chatKey` varchar(50) NOT NULL DEFAULT '128',
  `chatJoinKey` varchar(50) NOT NULL DEFAULT '128',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastActive` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `errorreports`
--

DROP TABLE IF EXISTS `errorreports`;
CREATE TABLE IF NOT EXISTS `errorreports` (
  `id` int NOT NULL,
  `string` varchar(1024) DEFAULT NULL,
  `ip` varchar(128) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

DROP TABLE IF EXISTS `forums`;
CREATE TABLE IF NOT EXISTS `forums` (
  `id` int NOT NULL,
  `catid` int DEFAULT NULL,
  `developer` int DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `locked` int DEFAULT '0',
  `posts` int DEFAULT '0',
  `replies` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friendrequests`
--

DROP TABLE IF EXISTS `friendrequests`;
CREATE TABLE IF NOT EXISTS `friendrequests` (
  `id` int NOT NULL,
  `senduid` int DEFAULT '0',
  `recvuid` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int NOT NULL,
  `userId1` int DEFAULT '0',
  `userId2` int DEFAULT '0',
  `friendSince` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gamejoins`
--

DROP TABLE IF EXISTS `gamejoins`;
CREATE TABLE IF NOT EXISTS `gamejoins` (
  `id` int NOT NULL,
  `uid` int DEFAULT '0',
  `gameId` int DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Table structure for table `gamekeys`
--

DROP TABLE IF EXISTS `gamekeys`;
CREATE TABLE IF NOT EXISTS `gamekeys` (
  `id` int NOT NULL,
  `userid` int NOT NULL DEFAULT '0',
  `key` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id` int NOT NULL,
  `version` int DEFAULT '0',
  `creator_uid` int DEFAULT '0',
  `public` int DEFAULT '0',
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `key` varchar(128) DEFAULT NULL,
  `privatekey` varchar(128) DEFAULT NULL,
  `placeURL` varchar(256) DEFAULT NULL,
  `port` int DEFAULT '53640',
  `numPlayers` int DEFAULT '0',
  `dedi` int DEFAULT '0',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `imgTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastPing` timestamp NULL DEFAULT NULL,
  `gearallowed` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int NOT NULL,
  `cuid` int NOT NULL DEFAULT '0',
  `closed` int NOT NULL DEFAULT '0',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(32) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `shout` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

DROP TABLE IF EXISTS `group_members`;
CREATE TABLE IF NOT EXISTS `group_members` (
  `id` int NOT NULL,
  `uid` int NOT NULL DEFAULT '0',
  `gid` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loginattempts`
--

DROP TABLE IF EXISTS `loginattempts`;
CREATE TABLE IF NOT EXISTS `loginattempts` (
  `id` int NOT NULL,
  `uid` int NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `count` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL,
  `recv_uid` int NOT NULL DEFAULT '0',
  `sender_uid` int NOT NULL DEFAULT '0',
  `read` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(64) DEFAULT NULL,
  `content` varchar(30000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `owneditems`
--

DROP TABLE IF EXISTS `owneditems`;
CREATE TABLE IF NOT EXISTS `owneditems` (
  `id` int NOT NULL,
  `uid` int DEFAULT '0',
  `catalogid` int DEFAULT '0',
  `type` varchar(50) DEFAULT NULL,
  `deleted` int DEFAULT '0',
  `rbxasset` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passwordresets`
--

DROP TABLE IF EXISTS `passwordresets`;
CREATE TABLE IF NOT EXISTS `passwordresets` (
  `id` int NOT NULL,
  `userId` int NOT NULL DEFAULT '0',
  `used` int NOT NULL DEFAULT '0',
  `key` varchar(256) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile_views`
--

DROP TABLE IF EXISTS `profile_views`;
CREATE TABLE IF NOT EXISTS `profile_views` (
  `id` int NOT NULL,
  `viewer` int NOT NULL DEFAULT '0',
  `profile` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

DROP TABLE IF EXISTS `pwdreset`;
CREATE TABLE IF NOT EXISTS `pwdreset` (
  `id` int NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `read`
--

DROP TABLE IF EXISTS `read`;
CREATE TABLE IF NOT EXISTS `read` (
  `id` int NOT NULL,
  `userId` int NOT NULL DEFAULT '0',
  `postId` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `renders`
--

DROP TABLE IF EXISTS `renders`;
CREATE TABLE IF NOT EXISTS `renders` (
  `id` int NOT NULL,
  `render_id` varchar(512) NOT NULL DEFAULT '0',
  `type` varchar(50) DEFAULT NULL,
  `rendered` int DEFAULT '0',
  `version` int DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

DROP TABLE IF EXISTS `replies`;
CREATE TABLE IF NOT EXISTS `replies` (
  `id` int NOT NULL,
  `forumId` int NOT NULL DEFAULT '0',
  `developer` int NOT NULL DEFAULT '0',
  `author_uid` int DEFAULT NULL,
  `postId` int DEFAULT NULL,
  `content` varchar(30000) DEFAULT NULL,
  `post_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int NOT NULL,
  `target` varchar(20) DEFAULT NULL,
  `reason` varchar(256) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `serverinfo`
--

DROP TABLE IF EXISTS `serverinfo`;
CREATE TABLE IF NOT EXISTS `serverinfo` (
  `Lastserver` int NOT NULL,
  `id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Table structure for table `serverrequests`
--

DROP TABLE IF EXISTS `serverrequests`;
CREATE TABLE IF NOT EXISTS `serverrequests` (
  `id` int NOT NULL,
  `placeLocation` varchar(512) DEFAULT NULL,
  `serverName` varchar(512) DEFAULT NULL,
  `serverDescription` varchar(512) DEFAULT NULL,
  `serverVersion` int DEFAULT '0',
  `serverPrivacy` int DEFAULT '0',
  `userID` int DEFAULT '0',
  `server` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int NOT NULL,
  `userId` int DEFAULT NULL,
  `factorFinish` int DEFAULT '0',
  `sessionId` varchar(255) DEFAULT NULL,
  `csrfToken` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `useragent` varchar(255) DEFAULT NULL,
  `lastUsed` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MEMORY DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int NOT NULL,
  `forumId` int NOT NULL DEFAULT '0',
  `developer` int NOT NULL DEFAULT '0',
  `author_uid` int DEFAULT '0',
  `locked` int DEFAULT '0',
  `lockedByStaff` int DEFAULT '0',
  `pinned` int DEFAULT '0',
  `views` int DEFAULT '0',
  `title` varchar(1024) DEFAULT NULL,
  `content` varchar(30000) DEFAULT NULL,
  `postTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastActivity` timestamp NULL DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT NULL,
  `updatedBy` int DEFAULT '0',
  `replies` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL,
  `banned` int NOT NULL DEFAULT '0',
  `publicBan` int NOT NULL DEFAULT '0',
  `bantype` int NOT NULL DEFAULT '0',
  `emailverified` int NOT NULL DEFAULT '0',
  `developer` int NOT NULL DEFAULT '0',
  `hatuploader` int NOT NULL DEFAULT '0',
  `charap` int NOT NULL DEFAULT '0',
  `inGameId` int NOT NULL DEFAULT '0',
  `emailverifyCode` varchar(256) DEFAULT NULL,
  `emailcodeTime` timestamp NULL DEFAULT NULL,
  `banreason` varchar(512) DEFAULT NULL,
  `bantime` timestamp NULL DEFAULT NULL,
  `username` varchar(21) DEFAULT NULL,
  `gameKey` varchar(128) DEFAULT NULL,
  `passwordChangeDate` timestamp NULL DEFAULT NULL,
  `about` varchar(256) DEFAULT NULL,
  `authId` varchar(256) DEFAULT NULL,
  `useragent` varchar(1024) DEFAULT NULL,
  `authKey` varchar(1024) DEFAULT NULL,
  `rank` int NOT NULL DEFAULT '0',
  `hideStatus` int NOT NULL DEFAULT '0',
  `coins` int NOT NULL DEFAULT '0',
  `posties` int NOT NULL DEFAULT '0',
  `imgTime` int NOT NULL DEFAULT '0',
  `passwordVersion` int NOT NULL DEFAULT '1',
  `imgp` int NOT NULL DEFAULT '1',
  `inGame` int NOT NULL DEFAULT '0',
  `themeChoice` int NOT NULL DEFAULT '0',
  `profileviews` int NOT NULL DEFAULT '0',
  `lastAward` timestamp NULL DEFAULT NULL,
  `lastAward2` timestamp NULL DEFAULT NULL,
  `joinDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastSeen` timestamp NULL DEFAULT NULL,
  `lastUpload` timestamp NULL DEFAULT NULL,
  `formcode` varchar(128) DEFAULT NULL,
  `lastPost` timestamp NULL DEFAULT NULL,
  `lastIDGen` timestamp NULL DEFAULT NULL,
  `lastFR` timestamp NULL DEFAULT NULL,
  `showAds` int DEFAULT '0',
  `posts` int DEFAULT '0',
  `lastForumContent` varchar(30000) DEFAULT '0',
  `membership` int NOT NULL DEFAULT '0',
  `hwid` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
