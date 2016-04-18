<?php
class ArambaApi {

	private $apikey;
	private $apiURL = 'https://api.aramba.ru';

	/** 
	 * Конструктор класса. К качестве параметра нужно указать API-ключ,
	 * который можно получить в личном кабинете.
	 */
	function __construct($apikey) {

		$this->apikey = $apikey;
	
	}
	
	/**
	 * Вспомогательный метод для формирования GET запроса
	 */
	function createGetRequest ($URL) {
	
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
			'Accept: application/json',  
			'Content-Type: application/json',  
			'Authorization: ApiKey '.$this->apikey));  

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	
		return $ch;
			
	}
	
	/**
	 * Вспомогательный метод для формирования POST запроса
	 */
	function createPostRequest ($URL, $postdata) {
			
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_POST, 1);  
  
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
			'Accept: application/json',  
			'Content-Type: application/json',  
			'Authorization: ApiKey '.$this->apikey));  
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			
		return $ch;
	}
	
	/** 
	 * Вспомогательный метод для формирования PUT запроса
	 */
	function createPutRequest ($URL, $postdata) {
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
		curl_setopt($ch, CURLOPT_PUT, 0);  
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
			'Accept: application/json',  
			'Content-Type: application/json',  
			'Authorization: ApiKey '.$this->apikey));  
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		
		return $ch;
		
	}
	
	/**
	 * Вспомогательный метод для формирования DELETE запроса
	 */
	function createDeleteRequest ($URL) {
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(  
			'Accept: application/json',  
			'Content-Type: application/json',  
			'Authorization: ApiKey '.$this->apikey));  
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		
		return $ch;
		
	}
	
	/**
	 * Вспомогательный метод для отправки запроса
	 */
	function sendRequest ($ch) {
		
		$response = curl_exec ($ch);  
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		curl_close ($ch); 
		
		return $this->parseResponse($http_code, $response);
		
	}
	
	/**
	 * Вспомогательный метод для формирования ответа в виде ассоциативного массива
	 */
	function parseResponse ($http_code, $response) {
	
		$p_response = json_decode($response, TRUE);
		
		if (empty($p_response)) {
			$p_response = array('http_code' => $http_code);
		} else {
			if (is_array($p_response)) {
				$p_response = array('http_code' => $http_code) + $p_response;
			} else {
				$p_response = array(
					'http_code' => $http_code,
					'response' => $p_response
				);
			}
		}
		
		return $p_response;
		
	}
	
	/** 
	 * Создание автоматической СМС рассылки
	 *
	 * @param string ContactGroupId 												 	Идентификатор группы контактов, по которой будет проводиться автоматическая СМС рассылка. 
	 *																				 	Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param string FilterId 														 	Идентификатор сохраненного в группе фильтра по контактам
	 *																				 	Идентификатор можно получить, выполнив запрос GET /ContactGroups c параметром IncludeFilters = True
	 * @param string Event 															 	Название колонки, которая будет являться событием, по которому будет проводиться автоматическая СМС рассылка
	 *																				 	Название колонки должно совпадать с названием колонки в базе контактов
	 * @param timespan SendTime 													 	Время отправки СМС
	 * @param enum(JustInTime, Before, After) SendType 	 							 	Направление смещения времени отправки СМС сообщений
	 * @param string SmsSenderId 													 	Имя отправителя СМС
	 * @param string SmsTemplate 													 	Шаблон (текст) СМС
	 * @param string AlternativeSmsTemplate												Альтернативный шаблон (текст)
	 * @param enum(MSK, YEKT, OMST, KRAT, IRKT, YAKT, VLAT, MAGT, UZS) LocalTimeZone 	Часовой пояс, по которому будет проводиться СМС рассылка
	 * @param boolean UseRecepientTimeZone 											 	True, если следует отправлять СМС по местному времени абонента
	 * @param boolean MustTransliterate 											 	True, если необходимо транслитерировать текст СМС перед отправкой
	 * @param int32 SendTimeOffset 													 	Количество дней, недель или месяцев, на которое надо смещать время отправки СМС
	 * @param enum(Day, Week, Month) SendTimeOffsetType 							 	Единица измерения смещения времени отправки СМС
	 *
	 * @return array
	 */
	function postAutoSmsSendings ($ContactGroupId, $FilterId, $Event, $SendTime, $SendType, $SmsSenderId,
							  $SmsTemplate, $AlternativeSmsTemplate, $LocalTimeZone, $UseRecepientTimeZone,
							  $MustTransliterate, $SendTimeOffset, $SendTimeOffsetType) {
							  
		$postdata = array(
			'ContactGroupId' => $ContactGroupId,
			'FilterId' => $FilterId,
			'Event' => $Event, 
			'SendTime' => $SendTime,
			'SendType' => $SendType,
			'SmsSenderId' => $SmsSenderId,
			'SmsTemplate' => $SmsTemplate,
			'AlternativeSmsTemplate' => $AlternativeSmsTemplate,
			'LocalTimeZone' => $LocalTimeZone,
			'UseRecepientTimeZone' => $UseRecepientTimeZone,
			'MustTransliterate' => $MustTransliterate,
			'SendTimeOffset' => $SendTimeOffset,
			'SendTimeOffsetType' => $SendTimeOffsetType
		);
		
		$URL = $this->apiURL . '/autoSmsSendings';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
  
		return $response;
			
	}
	
	/**
	 * Получить информацию об автоматических СМС рассылках в порядке от новых к старым
	 *
	 * @param uint32 Offset	Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit	Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 * 
	 * @return array
	 */
	function getAutoSmsSendings ($Offset, $Limit) {
	
		$URL = $this->apiURL . '/autoSmsSendings?offset=' . $Offset . '&limit=' . $Limit;
	
		$ch = $this->createGetRequest($URL);
  
		$response = $this->sendRequest($ch);
	
		return $response;
		
	}
	
	/**
	 * Изменить статус у существующей автоматической СМС рассылки
	 * 
	 * @param string Id 	Идентификатор автоматической СМС рассылки. Идентификатор можно получить, выполнив запрос GET /AutoSmsSendings
	 * @param string Status Статус одиночной автоматической СМС рассылки, принимает значения: Active или Paused
	 * 
	 * @return array
	 */
	function putAutoSmsSendingsId ($Id, $Status) {
		
		$postdata = array(
			'Status' => $Status
		);
		
		$URL = $this->apiURL . '/autoSmsSendings/' . $Id;
				
		$ch = $this->createPutRequest($URL, $postdata);
  
		$response = $this->sendRequest($ch);
  
		return $response;
		
	}
	
	/**
	 * Изменить статус у существующей автоматической СМС рассылки
	 *
	 * @param string Id 	Идентификатор автоматической СМС рассылки. Идентификатор можно получить, выполнив запрос GET /AutoSmsSendings
	 * @param string Status Статус одиночной автоматической СМС рассылки, принимает значения: Active или Paused
	 *
	 * @return array
	 */
	function postAutoSmsSendingsId ($Id, $Status) {
		
		$postdata = array(
			'Status' => $Status
		);
		
		$URL = $this->apiURL . '/autoSmsSendings/' . $Id;
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
  
		return $response;
		
	}
	
	/**
	 * Получить информацию о конкретной автоматической СМС рассылке
	 *
	 * @param string Id Идентификатор автоматической СМС рассылки. Идентификатор можно получить, выполнив запрос GET /AutoSmsSendings
	 *
	 * @return array
	 */
	function getAutoSmsSendingsId ($Id) {
	
		$URL = $this->apiURL . '/autoSmsSendings/' . $Id;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Изменить время отправки СМС у существующей СМС-рассылки. Изменения не повлияют на ближайший день рассылки, но повлияют на все последующие дни.
	 *
	 * @param string Id			Идентификатор автоматической СМС рассылки. Идентификатор можно получить, выполнив запрос GET /AutoSmsSendings
	 * @param timespan SendTime	Время отправки СМС
	 *
	 * @return array
	 */
	function putAutoSmsSendingsIdChangeTime ($Id, $SendTime) {
	
		$postdata = array(
			'SendTime' => $SendTime
		);
		
		$URL = $this->apiURL . '/autoSmsSendings/' . $Id . '/changeTime';
		
		$ch = $this->createPutRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Изменить время отправки СМС у существующей СМС-рассылки. Изменения не повлияют на ближайший день рассылки, но повлияют на все последующие дни.
	 *
	 * @param string Id 		Идентификатор автоматической СМС рассылки. Идентификатор можно получить, выполнив запрос GET /AutoSmsSendings
	 * @param timespan SendTime Время отправки СМС
	 *
	 * @return array
	 */
	function postAutoSmsSendingsIdChangeTime ($Id, $SendTime) {
	
		$postdata = array(
			'SendTime' => $SendTime
		);
		
		$URL = $this->apiURL . '/autoSmsSendings/' . $Id . '/changeTime';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить текущее значение баланса в рублях
	 *
	 * @return array
	 */
	function getBalance () {
	
		$URL = $this->apiURL . '/balance';
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
	
		return $response;
		
	}
	
	/**
	 * Получить историю заказов/платежей, начиная с недавних
	 *
	 * @param uint32 Offset Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit 	Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 *
	 * @return array
	 */
	function getBalancePayments ($Offset, $Limit) {
	
		$URL = $this->apiURL . '/balance/payments?offset=' . $Offset . '&limit=' . $Limit;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить текущий тариф
	 *
	 * @return array
	 */
	function getBalanceTariff () {
	
		$URL = $this->apiURL . '/balance/tariff';
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Получить все тарифы, доступные пользователю
	 *
	 * @return array
	 */
	function getBalanceTariffs () {
	
		$URL = $this->apiURL . '/balance/tariffs';
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Получить информацию об email-адресах в чёрном списке, начиная с недавно добавленных
	 *
	 * @param datetime(может быть null) StartUtcDateTime 	Фильтр по дате добавления, нижняя граница (UTC)
	 * @param datetime(может быть null) EndUtcDateTime 	 	Фильтр по дате добавления, верхняя граница (UTC)
	 * @param string SearchString							Строка поиска по email-адресам
	 * @param uint32 Offset 							 	Количество начальных элементов в результате, которые надо пропустить
     * @param uint32 Limit 								 	Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 *
	 * @return array
	 */
	function getBlackListEmailAddresses ($StartUtcDateTime, $EndUtcDateTime, $SearchString, $Offset, $Limit) {
	
		$URL = $this->apiURL . '/blackListEmailAddresses?StartUtcDateTime=' . $StartUtcDateTime . '&EndUtcDateTime=' . $EndUtcDateTime . 
			   '&SearchString=' . $SearchString . '&Offset=' . $Offset . '&Limit=' . $Limit;
			   
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;

	}
	
	/**
	 * Добавить email-адрес в чёрный список
	 *
	 * @param string Email		Email-адрес, подлежащий занесению в чёрный список
	 * @param string Comments	Комментарий к записи в чёрном списке (максимум — 100 символов)
	 *
	 * @return array
	 */ 
	function postBlackListEmailAddresses ($Email, $Comments) {
	
		$postdata = array(
			'Email' => $Email,
			'Comments' => $Comments
		);
		
		$URL = $this->apiURL . '/blackListEmailAddresses';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию о телефонных номерах в чёрном списке начиная с недавно добавленных
	 *
	 * @param datetime(может быть null) StartUtcDateTime 	Фильтр по дате добавления, нижняя граница (UTC)
	 * @param datetime(может быть null) EndUtcDateTime 	 	Фильтр по дате добавления, верхняя граница (UTC)
	 * @param string SearchString 							Строка поиска по номеру телефона
	 * @param uint32 Offset 								Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit 									Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 *
	 * @return array
	 */
	function getBlackListPhoneNumbers ($StartUtcDateTime, $EndUtcDateTime, $SearchString, $Offset, $Limit) {
	
		$URL = $this->apiURL . '/blackListPhoneNumbers?StartUtcDateTime=' . $StartUtcDateTime . '&EndUtcDateTime=' . $EndUtcDateTime .
			   '&SearchString=' . $SearchString . '&Offset=' . $Offset . '&Limit=' . $Limit;
			   
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;

	}
	
	/**
	 * Добавить телефонный номер в чёрный список
	 *
	 * @param string PhoneNumber 	Номер телефона, подлежащий занесению в чёрный список
	 * @param string Comments 		Комментарий к записи в чёрном списке (максимум — 100 символов)
	 *
	 * @return array
	 */
	function postBlackListPhoneNumbers ($PhoneNumber, $Comments) {
	
		$postdata = array(
			'PhoneNumber' => $PhoneNumber,
			'Comments' => $Comments
		);
		
		$URL = $this->apiURL . '/blackListPhoneNumbers';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию о конкретном email-адресе из чёрного списка
	 
	 * @param string Email Email-адрес, по которому нужно получить информацию
	 *
	 * @return array
	 */ 
	function getBlackListEmailAddressesEmail ($Email) {
	
		$URL = $this->apiURL . '/blackListEmailAddresses/' . $Email;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Изменить запись об email-адресе в чёрном списке
	 *
	 * @param string Email 		Email-адрес, сведения о котором нужно изменить
	 * @param string Comments 	Комментарий к записи в чёрном списке (максимум — 100 символов)
	 *
	 * @return array
	 */
	function postBlackListEmailAddressesEmail ($Email, $Comments) {
	
		$postdata = array(
			'Comments' => $Comments
		);
		
		$URL = $this->apiURL . '/blackListEmailAddresses/' . $Email;
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Изменить запись об email-адресе в чёрном списке
	 *	
	 * @param string Email 		Email-адрес, сведения о котором нужно изменить
	 * @param string Comments 	Комментарий к записи в чёрном списке (максимум — 100 символов)
	 *
	 * @return array
	 */
	function putBlackListEmailAddressesEmail ($Email, $Comments) {
	
		$postdata = array(
			'Comments' => $Comments
		);
		
		$URL = $this->apiURL . '/blackListEmailAddresses/' . $Email;
		
		$ch = $this->createPutRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Исключить email-адрес из чёрного списка
	 *
	 * @param string Email 	Email-адрес, подлежащий исключению из чёрного списка
	 *
	 * @return array
	 */
	function deleteBlackListEmailAddressesEmail ($Email) {
	
		$URL = $this->apiURL . '/blackListEmailAddresses/' . $Email;
		
		$ch = $this->createDeleteRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Исключить email-адрес из чёрного списка
	 *
	 * @param string Email 	Email-адрес, подлежащий исключению из чёрного списка
	 * 
	 * @return array
	 */
	function postBlackListEmailAddressesEmailDelete ($Email) {
	
		$postdata = '';
	
		$URL = $this->apiURL . '/blackListEmailAddresses/' . $Email . '/delete';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Изменить запись о телефоне в чёрном списке
	 *
	 * @param string PhoneNumber 	Телефонный номер, сведения о котором нужно изменить
	 * @param string Comments 		Комментарий к записи в чёрном списке
	 *
	 * @return array
	 */ 
	function postBlackListPhoneNumbersPhoneNumber ($PhoneNumber, $Comments) {
	
		$postdata = array(
			'Comments' => $Comments
		);
		
		$URL = $this->apiURL . '/blackListPhoneNumbers/' . $PhoneNumber;
		 
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Изменить запись о телефоне в чёрном списке
	 *
	 * @param string PhoneNumber	Телефонный номер, сведения о котором нужно изменить
	 * @param string Comments 		Комментарий к записи в чёрном списке
	 *
	 * @return array
	 */ 
	function putBlackListPhoneNumbersPhoneNumber ($PhoneNumber, $Comments) {
	
		$postdata = array(
			'Comments' => $Comments
		);
		
		$URL = $this->apiURL . '/blackListPhoneNumbers/' . $PhoneNumber;
		
		$ch = $this->createPutRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Исключить номер телефона из чёрного списка
	 *
	 * @param string PhoneNumber	Телефонный номер, подлежащий исключению из чёрного списка
	 *
	 * @return array
	 */
	function deleteBlackListPhoneNumbersPhoneNumber ($PhoneNumber) {
	
		$URL = $this->apiURL . '/blackListPhoneNumbers/' . $PhoneNumber;
		
		$ch = $this->createDeleteRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию о конкретном телефонном номере из чёрного списка
	 *
	 * @param string PhoneNumber	Телефонный номер, по которому нужно получить информацию
	 *
	 * @return array
	 */
	function getBlackListPhoneNumbersPhoneNumber ($PhoneNumber) {
		
		$URL = $this->apiURL . '/blackListPhoneNumbers/' . $PhoneNumber;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Исключить номер телефона из чёрного списка
	 *
	 * @param string PhoneNumber 	Телефонный номер, подлежащий исключению из чёрного списка
	 *
	 * @return array
	 */
	function postBlackListPhoneNumbersPhoneNumberDelete ($PhoneNumber) {
	
		$postdata = '';
	
		$URL = $this->apiURL . '/blackListPhoneNumbers/' . $PhoneNumber . '/delete';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Создать новую контактную группу
	 *
	 * @param string Name	Название группы контактов (от 3 до 25 символов)
	 *
	 * @return array
	 */
	function postContactGroups ($Name) {
	
		$postdata = array(
			'Name' => $Name
		);
		
		$URL = $this->apiURL . '/contactGroups';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию о группах контактов в порядке их создания
	 *
	 * @param string SearchQuery		Поисковая фраза
	 * @param uint32 Offset 			Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit 				Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 * @param boolean IncludeStatistics	True, если следует включать в ответ статистику по группе
	 * @param boolean IncludeFilters	True, если следует включать в ответ фильтры группы
	 * @param boolean IncludeColumns 	True, если следует включать в результат колонки группы	
	 *
	 * @return array
	 */
	function getContactGroups ($SearchQuery, $Offset, $Limit, $IncludeStatistics, $IncludeFilters, $IncludeColumns) {
	
		$URL = $this->apiURL . '/contactGroups?searchquery=' . $SearchQuery . '&Offset=' . $Offset . '&Limit=' . $Limit .
			   '&includestatistics=' . $IncludeStatistics . '&includefilters=' . $IncludeFilters . '&IncludeColumns=' . $IncludeColumns;
			   
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Переименовать контактную группу
	 * 
	 * @param string Id 	Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups 
	 * @param string Name	Название группы контактов (от 3 до 25 символов)
	 *
	 * @return array 
	 */
	function putContactGroupsId ($Id, $Name) {
	
		$postdata = array(
			'Name' => $Name
		);
		
		$URL = $this->apiURL . '/contactGroups/' . $Id;
		
		$ch = $this->createPutRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	}
	
	/**
	 * Переименовать контактную группу
	 * 
	 * @param string Id 	Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups 
	 * @param string Name	Название группы контактов (от 3 до 25 символов)
	 *
	 * @return array 
	 */
	function postContactGroupsId ($Id, $Name) {
	
		$postdata = array(
			'Name' => $Name
		);
		
		$URL = $this->apiURL . '/contactGroups/' . $Id;
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Удалить контактную группу
	 *
	 * @param string Id Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 *
	 * @return array
	 */
	function deleteContactGroupsId ($Id) {
	
		$URL = $this->apiURL . '/contactGroups/' . $Id;
		
		$ch = $this->createDeleteRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Получить информацию о конкретной группе контактов
	 * 
	 * @param string Id 				Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param boolean IncludeStatistics True, если следует включать в ответ статистику по группе
	 * @param boolean IncludeFilters 	True, если следует включать в ответ фильтры группы	
	 * @param boolean IncludeColumns 	True, если следует включать в результат колонки группы
	 *
	 * @return array
	 */
	function getContactGroupsId ($Id, $IncludeStatistics, $IncludeFilters, $IncludeColumns) {
		
		$URL = $this->apiURL . '/contactGroups/' . $Id . '?includestatistics=' . $IncludeStatistics . '&includefilters=' . $IncludeFilters . '&includecolumns=' . $IncludeColumns;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Удалить контактную группу
	 *
	 * @param string Id 	Идентификатор контакта. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 *
	 * @return array
	 */
	function postContactGroupsIdDelete ($Id) {
	
		$postdata = '';
		
		$URL = $this->apiURL . '/contactGroups/' . $Id . '/delete';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию об опечатках в конкретной контактной группе
	 *
	 * @param string GroupId 									Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param string SearchQuery 								Поисковая фраза
	 * @param string OrderBy 									Порядок сортировки	
	 * @param enum(ASC, DESC, может быть null) OrderDestination Направление сортировки
	 * @param uint32 Offset 									Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit 										Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 *
	 * @return array
	 */
	function getContactGroupsGroupIdTypos ($GroupId, $SearchQuery, $OrderBy, $OrderDestination, $Offset, $Limit) {
	
		$URL = $this->apiURL . '/contactGroups/' . $GroupId . '/typos?searchquery=' . $SearchQuery . '&orderby=' . $OrderBy . '&orderdestination=' . $OrderDestination . '&offset=' . $Offset . '&limit=' . $Limit;
		
		$ch = $this->createGetRequest($URL);
	
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию о конкретной опечатке в конкретной контактной группе
	 *
	 * @param string Id 		Идентификатор контакта. Идентификатор можно получить, выполнив запрос GET /ContactGroup/{id}/typos
	 * @param string GroupId 	Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 *
	 * @return array
	 */
	function getContactGroupsGroupIdTyposId ($Id, $GroupId) {
	
		$URL = $this->apiURL . '/contactGroups/' . $GroupId . '/typos/' . $Id;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Подтвердить исправления опечатки, предложенные Арамбой
	 *
	 * @param string Id 		Идентификатор контакта. Идентификатор можно получить, выполнив запрос GET /ContactGroup/{id}/typos
	 * @param string GroupId 	Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 *
	 * @return array
	 */
	function postContactGroupsGroupIdTyposIdApprove ($Id, $GroupId) {
	
		$postdata = '';
		
		$URL = $this->apiURL . '/contactGroups/' . $GroupId . '/typos/' . $Id . '/approve';
	
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Исправить опечатки самостоятельно, игнорируя предложенные Арамбой исправления
	 *
	 * @param string Id 							Идентификатор контакта. Идентификатор можно получить, выполнив запрос GET /ContactGroup/{id}/typos
	 * @param string GroupId 						Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param string CleanedFirstName 				Исправленное имя
	 * @param string CleanedLastName 				Исправленная фамилия
	 * @param string CleanedMiddleName 				Исправленное отчество
	 * @param boolean(может быть null) CleanedSex 	Исправленный пол, true — мужской пол, false — женский
	 *
	 * @return array
	 */
	function postContactGroupsGroupIdTyposIdCustom ($Id, $GroupId, $CleanedFirstName, $CleanedLastName, $CleanedMiddleName, $CleanedSex) {
	
		$postdata = array(
			'CleanedFirstName' => $CleanedFirstName, 
			'CleanedLastName' => $CleanedLastName,
			'CleanedMiddleName' => $CleanedMiddleName,
			'CleanedSex' => $CleanedSex
		);
		
		$URL = $this->apiURL . '/contactGroups/' . $GroupId . '/typos/' . $Id . '/custom';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Создать новую колонку в группе контактов
	 *
	 * @param string Id 										Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param enum(String, Number, Bool, Date, Decimal) Type	Тип колонки
	 * @param string Title 										Название колонки
	 * @param int32(может быть null) Index 						Индекс колонки, с отсчётом от нуля
	 *
	 * @return array
	 */
	function postContactGroupsIdColumns ($Id, $Type, $Title, $Index) {
	
		$postdata = array(
			'Type' => $Type,
			'Title' => $Title,
			'Index' => $Index
		);
		
		$URL = $this->apiURL . '/contactGroups/' . $Id . '/Columns';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию обо всех колонках группы контактов в порядке их индекса
	 *
	 * @param string Id		Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 *
	 * @return array
	 */
	function getContactGroupsIdColumns ($Id) {
	
		$URL = $this->apiURL . '/contactGroups/' . $Id . '/columns';
	
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Удалить колонку из группы контактов
	 *
	 * @param string Id 	Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param int32 Index 	Индекс колонки, с отсчётом от нуля. Идентификатор можно получить, выполнив запрос GET /ContactGroups/{id}/columns
	 *
	 * @return array
	 */
	function deleteContactGroupsIdColumnsIndex ($Id, $Index) {
	
		$URL = $this->apiURL . '/contactGroups/' . $Id . '/columns/' . $Index;
	
		$ch = $this->createDeleteRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Редактировать колонку группы контактов
	 *
	 * @param string Id 						Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param int32 OldIndex 					Индекс колонки, которая будет отредактирована, с отсчётом от нуля. Идентификатор можно получить, выполнив запрос GET /ContactGroups/{id}/columns
	 * @param string Title 						Название колонки
	 * @param int32(может быть null) NewIndex 	Индекс колонки после редактирования, с отсчётом от нуля
	 *
	 * @return array
	 */
	function postContactGroupsIdColumnsIndex ($Id, $OldIndex, $Title, $NewIndex) {
	
		$postdata = array(
			'Title' => $Title,
			'Index' => $NewIndex
		);
		
		$URL = $this->apiURL . '/contactGroups/' . $Id . '/columns/' . $OldIndex;
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Редактировать колонку группы контактов
	 *
	 * @param string Id 						Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param int32 OldIndex 					Индекс колонки, которая будет отредактирована, с отсчётом от нуля. Идентификатор можно получить, выполнив запрос GET /ContactGroups/{id}/columns
	 * @param string Title 						Название колонки
	 * @param int32(может быть null) NewIndex 	Индекс колонки после редактирования, с отсчётом от нуля
	 *
	 * @return array
	 */
	function putContactGroupsIdColumnsIndex ($Id, $OldIndex, $Title, $NewIndex) {
	
		$postdata = array(
			'Title' => $Title,
			'Index' => $NewIndex
		);
		
		$URL = $this->apiURL . '/contactGroups/' . $Id . '/columns/' . $OldIndex;
		
		$ch = $this->createPutRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Получить информацию о конкретной колонке группы контактов
	 *
	 * @param string Id 	Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param int32 Index 	Индекс колонки, с отсчётом от нуля. Идентификатор можно получить, выполнив запрос GET /ContactGroups/{id}/columns
	 *
	 * @return array
	 */
	function getContactGroupsIdColumnsIndex ($Id, $Index) {
	
		$URL = $this->apiURL . '/contactGroups/' . $Id . '/columns/' . $Index;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Удалить колонку из группы контактов
	 *
	 * @param string Id 	Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param int32 Index 	Индекс колонки, с отсчётом от нуля. Идентификатор можно получить, выполнив запрос GET /ContactGroups/{id}/columns
	 *
	 * @return array
	 */
	function postContactGroupsIdColumnsIndexDelete ($Id, $Index) {
	
		$postdata = '';
		
		$URL = $this->apiURL . '/contactGroups/' . $Id . '/columns/' . $Index . '/delete';
	
		$ch = $this->createPostRequest($URL, $postdata);
	
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Добавить в группу новый контакт
	 *
	 * @param string Id 	Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param array Data 	Данные контакта, передаются в виде словаря. Словарь должен из себя представлять ассоциативный массив вида array("Имя" => "Антон", "Номер телефона" => "79214571245");
	 *
	 * @return array 
	 */
	function postContactGroupsIdContacts ($Id, $Data) {
	
		$postdata = array(
			'Data' => $Data
		);
		
		$URL = $this->apiURL . '/contactGroups/' . $Id . '/contacts';
	
		$ch = $this->createPostRequest($URL, $postdata);
	
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию о контактах контактной группы
	 *
	 * @param string Id 										Идентификатор группы контактов. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param string SearchQuery 								Поисковая фраза
	 * @param string OrderBy 									Порядок сортировки
	 * @param enum(ASC, DESC, может быть null) OrderDestination Направление сортировки
	 * @param uint32 Offset										Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit										Количество элементов, которые необходимо вернуть(максимум — 500, по умолчанию — 50)
	 *
	 * @return array
	 */
	function getContactGroupsIdContacts ($Id, $SearchQuery, $OrderBy, $OrderDestination, $Offset, $Limit) {
	
		$URL = $this->apiURL . '/contactGroups/' . $Id . '/contacts?searchQuery=' . $SearchQuery . '&orderBy=' . $OrderBy . '&OrderDestination=' . $OrderDestination . '&offset=' . $Offset . '&limit=' . $Limit;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Удалить контакт
	 *
	 * @param string Id Идентификатор контакта. Идентификатор можно получить, выполнив запрос GET /ContactsGroup/{id}/contacts
	 *
	 * @return array
	 */
	function deleteContactsId ($Id) {
	
		$URL = $this->apiURL . '/contacts/' . $Id;
		
		$ch = $this->createDeleteRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Изменить данные контакта
	 *
	 * @param string Id 	Идентификатор контакта. Идентификатор можно получить, выполнив запрос GET /ContactsGroup/{id}/contacts
	 * @param array Data	Данные контакта, передаются в виде словаря. Словарь должен из себя представлять ассоциативный массив вида array("Имя" => "Антон", "Номер телефона" => "79214571245");
	 *
	 * @return array
	 */
	function postContactsId ($Id, $Data) {
	
		$postdata = array(
			'Data' => $Data
		);
	
		$URL = $this->apiURL . '/contacts/' . $Id;
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Изменить данные контакта
	 *
	 * @param string Id 	Идентификатор контакта. Идентификатор можно получить, выполнив запрос GET /ContactsGroup/{id}/contacts
	 * @param array Data 	Данные контакта, передаются в виде словаря. Словарь должен из себя представлять ассоциативный массив вида array("Имя" => "Антон", "Номер телефона" => "79214571245");
	 *
	 * @return array
	 */
	function putContactsId ($Id, $Data) {
	
		$postdata = array(
			'Data' => $Data
		);
	
		$URL = $this->apiURL . '/contacts/' . $Id;
		
		$ch = $this->createPutRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию о конкретном контакте
	 * 
	 * @param string Id Идентификатор контакта. Идентификатор можно получить, выполнив запрос GET /ContactsGroup/{id}/contacts
	 * 
	 * @return array
	 */
	function getContactsId ($Id) {
	
		$URL = $this->apiURL . '/contacts/' . $Id;
		
		$ch = $this->createGetRequest($URL);
	
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Удалить контакт
	 *
	 * @param string Id Идентификатор контакта. Идентификатор можно получить, выполнив запрос GET /ContactsGroup/{id}/contacts
	 *
	 * @return array
	 */
	function postContactsIdDelete ($Id) {
	
		$postdata = '';
	
		$URL = $this->apiURL . '/contacts/' . $Id . '/delete';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить email-адреса отправителя в алфавитном порядке
	 *
	 * @param uint32 Offset Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit	Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 *
	 * @return array
	 */
	function getEmailAddresses ($Offset, $Limit) {
	
		$URL = $this->apiURL . '/emailAddresses?offset=' . $Offset . '&Limit=' . $Limit;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Добавить email-адрес отправителя
	 * 
	 * @param string EmailAddress	Email-адрес отправителя
	 *
	 * @return array
	 */
	function postEmailAddresses ($EmailAddress, $EmailSenderName) {
	
		$postdata = array(
			'EmailAddress' => $EmailAddress,
			'EmailSenderName' => $EmailSenderName
		);
	
		$URL = $this->apiURL . '/emailAddresses';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Добавить имя отправителя SMS (Sender ID)
	 *
	 * @param string SenderId	Имя отправителя (Sender ID)
	 *
	 * @return array
	 */
	function postSmsSenderIds ($SenderId) {
	
		$postdata = array(
			'SenderId' => $SenderId
		);
		
		$URL = $this->apiURL . '/smsSenderIds';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить заверенные имена отправителя SMS (Sender ID) в алфавитном порядке
	 *
	 * @param uint32 Offset 	Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit 		Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 *
	 * @return array
	 */
	function getSmsSenderIds ($Offset, $Limit) {
	
		$URL = $this->apiURL . '/smsSenderIds?offset=' . $Offset . '&Limit=' . $Limit;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Создать новую email-рассылку
	 *
	 * @param string SenderEmailAddress 			Адрес email отправителя, который нужно использовать для рассылки. Должен быть в списке заверенных адресов отправителя
	 * @param string SubjectTemplate 				Шаблон темы основного сообщения
	 * @param string BodyTemplate 					Шаблон тела основного сообщения
	 * @param string AlternativeSubjectTemplate 	Шаблон темы сообщения для пользователей с пустыми полями
	 * @param string AlternativeBodyTemplate 		Шаблон тела сообщения для пользователей с пустыми полями
	 * @param string ContactGroupId 				Идентификатор контактной группы, по которой нужно произвести рассылку. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param string FilterId 						Индентификатор сохраненного в группе фильтра по контактам. Если не указан, рассылка будет производиться по всем контактам группы
	 *												Идентификатор можно получить, выполнив запрос GET /ContactGroups c параметром IncludeFilters = True
	 * @param datetime SendDateTime					Дата и время запуска рассылки
	 * @param string UnsubscribeText				Текст ссылки для отписки
	 * @param string SubscribeReason				Текст причины для подписки
	 * @param boolean PostponeScheduling			Отложенная постановка в очередь
	 *
	 * @return array
	 */
	function postEmailSendings ($SenderEmailAddress, $SubjectTemplate, $BodyTemplate, $AlternativeSubjectTemplate,
								$AlternativeBodyTemplate, $ContactGroupId, $FilterId, $SendDateTime, $UnsubscribeText, $SubscribeReason, $PostponeScheduling) {
	
		$postdata = array(
			'SenderEmailAddress' => $SenderEmailAddress,
			'SubjectTemplate' => $SubjectTemplate,
			'BodyTemplate' => $BodyTemplate, 
			'AlternativeSubjectTemplate' => $AlternativeSubjectTemplate,
			'AlternativeBodyTemplate' => $AlternativeBodyTemplate,
			'ContactGroupId' => $ContactGroupId,
			'FilterId' => $FilterId,
			'SendDateTime' => $SendDateTime,
			'UnsubscribeText' => $UnsubscribeText,
			'SubscribeReason' => $SubscribeReason,
			'PostponeScheduling' => $PostponeScheduling
		);
		
		$URL = $this->apiURL . '/emailSendings';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;

	}
	
	/** 
	 * Добавить получателей к email-рассылке, ещё не поставленной в очередь. Метод можно вызывать много раз для дополнения списка
	 * 
	 * @param string Id 			Идентификатор email-рассылки
	 * @param string Dictionary 	Словарь
	 *
	 * @return array
	 */
	function postEmailSendingsIdRecipients ($Id, $Dictionary) {
		
		$postdata = $Dictionary;
		
		$URL = $this->apiURL . '/emailSendings/' . $Id . '/recipients';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	}
	
	/**
	 * Поставить в очередь ранее созданную email-рассылку
	 *
	 * @param string Id 	Идентификатор email-рассылки
	 *
	 * @return array
	 */
	function postEmailSendingsIdSchedule ($Id) {
		
		$postdata = '';
		
		$URL = $this->apiURL . '/emailSendings/' . $Id . "/schedule";
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	}
	
	/**
	 * Создать новую email-рассылку по заранее подготовленному шаблону
	 *
	 * @param string Id								Шифрованный идентификатор шаблона
	 * @param string SenderEmailAddress 			Адрес email отправителя, который нужно использовать для рассылки. Должен быть в списке заверенных адресов отправителя
	 * @param string ContactGroupId 				Идентификатор контактной группы, по которой нужно произвести рассылку. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param string FilterId 						Индентификатор сохраненного в группе фильтра по контактам. Если не указан, рассылка будет производиться по всем контактам группы
	 *												Идентификатор можно получить, выполнив запрос GET /ContactGroups c параметром IncludeFilters = True
	 * @param datetime SendDateTime					Дата и время запуска рассылки
	 * @param string UnsubscribeText				Текст ссылки для отписки
	 * @param string SubscribeReason				Текст причины для подписки
	 * @param boolean PostponeScheduling			Отложенная постановка в очередь
	 *
	 * @return array
	 */
	function postEmailSendingsTemplateId ($Id, $SenderEmailAddress, $ContactGroupId, $FilterId, $SendDateTime, $UnsubscribeText, $SubscribeReason, $PostponeScheduling) {
		
		$postdata = array(
			'SenderEmailAddress' => $SenderEmailAddress,
			'ContactGroupId' => $ContactGroupId,
			'FilterId' => $FilterId,
			'SendDateTime' => $SendDateTime,
			'UnsubscribeText' => $UnsubscribeText,
			'SubscribeReason' => $SubscribeReason,
			'PostponeScheduling' => $PostponeScheduling
		);
		
		$URL = $this->apiURL . '/emailSendings/templateId/' . $Id;
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	}
	
	/**
	 * Создать новую email-рассылку по заранее подготовленному шаблону
	 *
	 * @param string Name							Имя шаблона
	 * @param string SenderEmailAddress 			Адрес email отправителя, который нужно использовать для рассылки. Должен быть в списке заверенных адресов отправителя
	 * @param string ContactGroupId 				Идентификатор контактной группы, по которой нужно произвести рассылку. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param string FilterId 						Индентификатор сохраненного в группе фильтра по контактам. Если не указан, рассылка будет производиться по всем контактам группы
	 *												Идентификатор можно получить, выполнив запрос GET /ContactGroups c параметром IncludeFilters = True
	 * @param datetime SendDateTime					Дата и время запуска рассылки
	 * @param string UnsubscribeText				Текст ссылки для отписки
	 * @param string SubscribeReason				Текст причины для подписки
	 * @param boolean PostponeScheduling			Отложенная постановка в очередь
	 *
	 * @return array
	 */
	function postEmailSendingsTemplateName ($Name, $SenderEmailAddress, $ContactGroupId, $FilterId, $SendDateTime, $UnsubscribeText, $SubscribeReason, $PostponeScheduling) {
		
		$postdata = array(
			'SenderEmailAddress' => $SenderEmailAddress,
			'ContactGroupId' => $ContactGroupId,
			'FilterId' => $FilterId,
			'SendDateTime' => $SendDateTime,
			'UnsubscribeText' => $UnsubscribeText,
			'SubscribeReason' => $SubscribeReason,
			'PostponeScheduling' => $PostponeScheduling
		);
		
		$URL = $this->apiURL . '/emailSendings/templateName/' . $Name;
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	}
	
	/**
	 * Получить информацию о созданных email-рассылках в порядке от новых к старым
	 * 
	 * @param uint32 Offset 	Количество начальных элементов в результате, которые надо пропустить 
	 * @param uint32 Limit 		Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 * 
	 * @return array
	 */
	function getEmailSendings ($Offset, $Limit) {
	
		$URL = $this->apiURL . '/emailSendings?offset=' . $Offset . '&limit=' . $Limit;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить стоимость email-рассылки
	 *
	 * @param string ContactGroupId 	Идентификатор контактной группы, по которой нужно произвести рассылку. Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param string FilterId 			Индентификатор сохраненного в группе фильтра по контактам. Если не указан, рассылка будет производиться по всем контактам группы
	 *									Идентификатор можно получить, выполнив запрос GET /ContactGroups c параметром IncludeFilters = True		
	 *
	 * @return array
	 */
	function postEmailSendingsCost ($ContactGroupId, $FilterId) {
	
		$postdata = array(
			'ContactGroupId' => $ContactGroupId,
			'FilterId' => $FilterId
		);
		
		$URL = $this->apiURL . '/emailSendings/cost';
	
		$ch = $this->createPostRequest($URL, $postdata);
	
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}	
	
	/**
	 * Получить информацию о конкретной email-рассылке
	 * 
	 * @param string Id		Идентификатор email-рассылки. Идентификатор можно получить, выполнив запрос GET /EmailSendings 
	 *
	 * @return array
	 */
	function getEmailSendingsId ($Id) {
	
		$URL = $this->apiURL . '/emailSendings/' . $Id;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);

		return $response;
		
	}
	
	/**
	 * Отправить одиночное Email-сообщение
	 *
	 * @param string Subject 		Тема Email	
	 * @param string Body 			Тело Email
	 * @param string FromAddress 	Email-адрес отправителя (должен быть в перечне разрешенных адресов в профиле)
	 * @param string ToAddress 		Email-адрес получателя
	 *
	 * @return array
	 */
	function postSingleEmail ($Subject, $Body, $FromAddress, $ToAddress) {
		
		$postdata = array(
			'Subject' => $Subject,
			'Body' => $Body,
			'FromAddress' => $FromAddress,
			'ToAddress' => $ToAddress
		);
		
		$URL = $this->apiURL . '/singleEmail';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Отправить одиночное Email-сообщение по идентификатору шаблона
	 * 
	 * Для отправки письма можно передавать либо словарь со всеми переменными в теле запроса,
	 * либо email контакта и шифрованный индентификатор его группы в строке запроса, либо идентификатор контакта в строке запроса
	 *
	 * @param string Id				Индентификатор шаблона
	 * @param string FromAddress	Адрес отправителя
	 * @param string ContactId		Индентификатор контакта
	 * @param string ToAddress		Email-адрес получателя. Использовать только в связке с параметром GroupId
	 * @param string GroupId		Индентификатор группы контактов. Использовать только в связке с параметром ToAddress.
	 * @param array Dictionary		Словарь. Использовать только, если не указаны параметры ContactId или ToAddress в паре с GroupId. 
	 *								Словарь должен из себя представлять ассоциативный массив вида array("Имя" => "Антон", "Электронная почта" => "aokhrimenko@smsdelivery.ru");
	 *
	 * @return array
	 */
	function postSingleEmailTemplateId ($Id, $FromAddress, $ContactId, $ToAddress, $GroupId, $Dictionary) {
		
		$URL = $this->apiURL . '/singleEmail/templateId/' . $Id . '?fromAddress=' . $FromAddress;
		
		if (!empty($ContactId)) {
			$URL .= "&contactId=" . $ContactId; 
		}
		
		if (!empty($ToAddress) && !empty($GroupId)) {
			$URL .= "&toAddress=" . $ToAddress . "&contactGroupId=" . $GroupId; 
		}
	
		if (!empty($Dictionary)) {
			$postdata = $Dictionary;
		} else {
			$postdata = '';
		}

		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	}
	
	/**
	 * Отправить одиночное Email-сообщение по имени шаблона
	 * 
	 * Для отправки письма можно передавать либо словарь со всеми переменными в теле запроса,
	 * либо email контакта и шифрованный индентификатор его группы в строке запроса, либо идентификатор контакта в строке запроса
	 *
	 * @param string Name			Имя шаблона
	 * @param string FromAddress	Адрес отправителя
	 * @param string ContactId		Индентификатор контакта
	 * @param string ToAddress		Email-адрес получателя. Использовать только в связке с параметром GroupId
	 * @param string GroupId		Индентификатор группы контактов. Использовать только в связке с параметром ToAddress.
	 * @param array Dictionary		Словарь. Использовать только, если не указаны параметры ContactId или ToAddress в паре с GroupId.
	 *								Словарь должен из себя представлять ассоциативный массив вида array("Имя" => "Антон", "Электронная почта" => "aokhrimenko@smsdelivery.ru");
	 *
	 * @return array
	 */
	function postSingleEmailTemplateName ($Name, $FromAddress, $ContactId, $ToAddress, $GroupId, $Dictionary) {
		
		$URL = $this->apiURL . '/singleEmail/templateName/' . $Name . '?fromAddress=' . $FromAddress;
		
		if (!empty($ContactId)) {
			$URL .= "&contactId=" . $ContactId; 
		}
		
		if (!empty($ToAddress) && !empty($GroupId)) {
			$URL .= "&toAddress=" . $ToAddress . "&contactGroupId=" . $GroupId; 
		}
	
		if (!empty($Dictionary)) {
			$postdata = $Dictionary;
		} else {
			$postdata = '';
		}

		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	}
	
	/**
	 * Получить информацию об отправленных одиночных СМС-сообщениях в порядке от новых к старым
	 *
	 * @param datetime(может быть null) StartUtcDateTime 	Фильтр по дате, нижняя граница (UTC)
	 * @param datetime(может быть null) EndUtcDateTime 		Фильтр по дате, верхняя граница (UTC)
	 * @param string SenderId 								Фильтр по имени отправителя СМС	
	 * @param string PhoneNumber 							Фильтр по номеру телефона
	 * @param uint32 Offset 								Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit 									Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 *
	 * @return array
	 */
	function getSingleSms ($StartUtcDateTime, $EndUtcDateTime, $SenderId, $PhoneNumber, $Offset, $Limit) {
	
		$URL = $this->apiURL . '/singleSms?startutcdatetime=' . $StartUtcDateTime . '&endutcdatetime=' . $EndUtcDateTime . '&senderid=' . $SenderId .
																 '&phonenumber=' . $PhoneNumber . '&offset=' . $Offset . '&limit=' . $Limit;
																 
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	
	}
	
	/**
	 * Отправить одиночное СМС-сообщение
	 *
	 * @param string SenderId 				Имя отправителя СМС
	 * @param string SendDateTime 			Дата и время, в которое следует отправить СМС. Оставьте пустым для немедленной отправки. 
	 *										При UseRecepientTimeZone = True укажите здесь время в часовой зоне абонента. Иначе укажите здесь время UTC
	 * @param boolean UseRecepientTimeZone 	True, если следует отправлять СМС по местному времени абонента	
	 * @param string PhoneNumber 			Номер телефона, на который нужно отправить сообщение
	 * @param string Text 					Текст СМС
	 *
	 * @return array
	 */
	function postSingleSms ($SenderId, $SendDateTime, $UseRecepientTimeZone, $PhoneNumber, $Text) { 
		  
		$postdata = array(  
			'SenderId' => $SenderId,  
			'SendDateTime' => $SendDateTime,
			'UseRecepientTimeZone' => $UseRecepientTimeZone,
			'PhoneNumber' => $PhoneNumber,     
			'Text' => $Text              
		);  
		
		$URL = $this->apiURL . '/SingleSms';
  
		$ch = $this->createPostRequest($URL, $postdata);
  
		$response = $this->sendRequest($ch);
  
		return $response;
		
	}
	
	/**
	 * Получить стоимость одиночного СМС-сообщения
	 *
	 * @param string SenderId		Имя отправителя
	 * @param string PhoneNumber 	Номер телефона, на который нужно отправить сообщение
	 * @param string Text 			Текст СМС
	 *
	 * @return array
	 */
	function postSingleSmsCost ($SenderId, $PhoneNumber, $Text) {
	
		$postdata = array(
			'SenderId' => $SenderId,
			'PhoneNumber' => $PhoneNumber,
			'Text' => $Text
		);
		
		$URL = $this->apiURL . '/singleSms/cost';
	
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Отправить одиночные СМС-сообщение (одинаковый текст на несколько номеров)
	 *
	 * @param string[] PhoneNumbers 					Номера телефонов, на которые нужно отправить сообщения	
	 * @param string Text 								Текст СМС
	 * @param string SenderId 							Имя отправителя СМС
	 * @param datetime(может быть null) SendDateTime 	Дата и время, в которое следует отправить СМС. Оставьте пустым для немедленной отправки. 
														При UseLocalTimeZone = True укажите здесь время в часовой зоне абонента. Иначе укажите здесь время UTC
	 * @param boolean UseRecepientTimeZone 				True, если следует отправлять СМС по местному времени абонента	
	 *
	 * @return array
	 */
	function postSingleSmsMultiple ($PhoneNumbers, $Text, $SenderId, $SendDateTime, $UseRecepientTimeZone) {
	
		$postdata = array(
			'PhoneNumbers' => preg_split("/[,]+/", $PhoneNumbers),
			'Text' => $Text,
			'SenderId' => $SenderId,
			'SendDateTime' => $SendDateTime,
			'UseRecepientTimeZone' => $UseRecepientTimeZone
		);
		
		$URL = $this->apiURL . '/singleSms/multiple';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию о конкретном одиночном СМС-сообщении
	 *
	 * @param string Id Идентификатор одиночного СМС-сообщения.
	 *
	 * @return array
	 */
	function getSingleSmsId ($Id) {
	
		$URL = $this->apiURL . '/singleSms/' . $Id;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Создать новую СМС-рассылку
	 * 
	 * @param string SmsSenderId 			Имя отправителя
	 * @param datetime SendDateTime 		Дата и время, в которое следует выполнить СМС-рассылку. Оставьте пустым для немедленной отправки. 
	 *										При UseRecepientTimeZone = True укажите здесь время в часовой зоне абонента. Иначе укажите здесь время UTC
	 * @param boolean UseRecepientTimeZone 	True — если следует отправлять СМС по местному времени абонента
	 * @param string ContactGroupId 		Идентификатор контактной группы, по которой нужно произвести рассылку
											Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param string FilterId 				Индентификатор сохраненного в группе фильтра по контактам. Если не указан, рассылка будет производиться по всем контактам группы
											Идентификатор можно получить, выполнив запрос GET /ContactGroups c параметром IncludeFilters = True
	 * @param string SmsTemplate 			Шаблон основного сообщения
	 * @param string AlternativeSmsTemplate Шаблон сообщения для пользователей с пустыми полями	
	 * @param boolean Transliterate 		True, если следует предварительно транслитерировать текст сообщения с русского на английский
	 *
	 * @return array
	 */
	function postSmsSendings ($SmsSenderId, $SendDateTime, $UseRecepientTimeZone, $ContactGroupId, 
							  $FilterId, $SmsTemplate, $AlternativeSmsTemplate, $Transliterate) {
							  
		$postdata = array(
			'SmsSenderId' => $SmsSenderId,
			'SendDateTime' => $SendDateTime,
			'UseRecepientTimeZone' => $UseRecepientTimeZone,
			'ContactGroupId' => $ContactGroupId,
			'FilterId' => $FilterId,
			'SmsTemplate' => $SmsTemplate,
			'AlternativeSmsTemplate' => $AlternativeSmsTemplate,
			'Transliterate' => $Transliterate
		);
		
		$URL = $this->apiURL . '/smsSendings';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Получить информацию о созданных смс-рассылках в порядке от новых к старым
	 *
	 * @param uint32 Offset 	Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit 		Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 *
	 * @return array
	 */
	function getSmsSendings ($Offset, $Limit) {
	
		$URL = $this->apiURL . '/smsSendings?offset=' . $Offset . '&limit=' . $Limit;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Рассчитать стоимость смс-рассылки
	 *
	 * @param string ContactGroupId 			Идентификатор контактной группы, по которой нужно произвести рассылку
												Идентификатор можно получить, выполнив запрос GET /ContactGroups
	 * @param string FilterId 					Индентификатор сохраненного в группе фильтра по контактам. Если не указан, рассылка будет производиться по всем контактам группы
												Идентификатор можно получить, выполнив запрос GET /ContactGroups c параметром IncludeFilters = True
	 * @param string SmsTemplate 				Шаблон основного сообщения	
	 * @param string AlternativeSmsTemplate 	Шаблон сообщения для пользователей с пустыми полями	
	 * @param boolean Transliterate 			True, если следует предварительно транслитерировать текст сообщения с русского на английский	
	 *
	 * @return array
	 */
	function postSmsSendingsCost ($ContactGroupId, $FilterId, $SmsTemplate, $AlternativeSmsTemplate, $Transliterate) {
	
		$postdata = array(
			'ContactGroupId' => $ContactGroupId,
			'FilterId' => $FilterId,
			'SmsTemplate' => $SmsTemplate,
			'AlternativeSmsTemplate' => $AlternativeSmsTemplate,
			'Transliterate' => $Transliterate
		);
		
		$URL = $this->apiURL . '/smsSendings/cost';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию о конкретной смс-рассылке
	 *
	 * @param string Id Идентификатор смс-рассылки. Идентификатор можно получить, выполнив запрос GET /SmsSendings
	 *
	 * @return array
	 */
	function getSmsSendingsId ($Id) {
	
		$URL = $this->apiURL . '/smsSendings/' . $Id;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить список субаккаунтов в алфавитном порядке
	 *
	 * @param uint32 Offset 	Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit 		Количество элементов, которые необходимо вернуть (максимум — 500, по умолчанию — 50)
	 *
	 * @return array
	 */
	function getSubAccounts ($Offset, $Limit) {
	
		$URL = $this->apiURL . '/subAccounts?offset=' . $Offset . '&limit=' . $Limit;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Создать новый субаккаунт
	 *
	 * @param string Login 																					Логин субаккаунта
	 * @param string Email 																					Email-адрес субаккаунта
	 * @param string Password 																				Пароль субаккаунта
	 * @param enum(All, Include, Exclude) ContactGroupAccessType 											Тип прав на группы контактов
	 * @param string[] ContactGroupIdsAccess 																Идентификаторы контактных групп, к которым устанавливаются права в свойстве ContactGroupAccessType,
	 *																										в случае Include или Exclude
	 * @param string[] Emails 																				Разрешённые email-адреса отправителя
	 * @param string[] SenderIds 																			Разрешённые имена отправителя СМС (Sender ID)
	 * @param string FullName 																				Полное имя пользователя субаккаунта
	 * @param enum(EditContact, SmsSending, EmailSending, SingleSmsSending, EditContactGroup) AccessRights 	Права доступа
	 * @param string Position 																				Должность
	 *
	 * @return array
	 */
	function postSubAccounts ($Login, $Email, $Password, $ContactGroupAccessType,
							  $ContactGroupIdsAccess, $Emails, $SenderIds, $FullName, $AccessRights, $Position) {
	
		$postdata = array(
			'Login' => $Login,
			'Email' => $Email,
			'Password' => $Password,
			'ContactGroupAccessType' => $ContactGroupAccessType, 
			'ContactGroupIdsAccess' => preg_split("/[,]+/", $ContactGroupIdsAccess),
			'Emails' => preg_split("/[,]+/", $Emails),
			'SenderIds' => preg_split("/[,]+/", $SenderIds),
			'FullName' => $FullName,
			'AccessRights' => preg_split("/[,]+/", $AccessRights),
			'Position' => $Position
		);
		
		$URL = $this->apiURL . '/subAccounts';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Получить информацию о конкретном субаккунте
	 *
	 * @param string Login 	Логин субаккаунта
	 *
	 * @return array
	 */
	function getSubAccountsLogin ($Login) {
	
		$URL = $this->apiURL . '/subAccounts/' . $Login;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Удалить субаккаунт
	 *
	 * @param string Login	Логин субаккаунта 
	 *
	 * @return array
	 */
	function deleteSubAccountsLogin ($Login) {
	
		$URL = $this->apiURL . '/subAccounts/' . $Login;
		
		$ch = $this->createDeleteRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Обновить сведения о субаккаунте
	 *
	 * @param string Login 																					Логин субаккаунта 
	 * @param string Email 																					Email-адрес субаккаунта
	 * @param string Password 																				Пароль субаккаунта
	 * @param string FullName 																				Полное имя пользователя субаккаунта
	 * @param enum(EditContact, SmsSending, EmailSending, SingleSmsSending, EditContactGroup) AccessRights 	Права доступа
	 * @param string Position 																				Должность
	 *
	 * @return array
	 */
	function postSubAccountsLogin ($Login, $Email, $Password, $FullName, $AccessRights, $Position) {
	
		$postdata = array(
			'Email' => $Email,
			'Password' => $Password,
			'FullName' => $FullName, 
			'AccessRights' => preg_split("/[,]+/", $AccessRights),
			'Position' => $Position
		);
		
		$URL = $this->apiURL . '/subAccounts/' . $Login;
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Удалить субаккаунт
	 *
	 * @param string Login	Логин субаккаунта 
	 *
	 * @return array
	 */
	function postSubAccountsLoginDelete ($Login) {
	
		$postdata = '';
	
		$URL = $this->apiURL . '/subAccounts/' . $Login . '/delete';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Заблокировать субаккаунт
	 *
	 * @param string Login	Логин субаккаунта
	 *
	 * @return array
	 */
	function postSubAccountsLoginLock ($Login) {
	
		$postdata = '';
		
		$URL = $this->apiURL . '/subAccounts/' . $Login . '/lock';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	
	}
	
	/**
	 * Разблокировать субаккаунт
	 *
	 * @param string Login 	Логин субаккаунта
	 *
	 * @return array
	 */
	function postSubAccountsLoginUnlock ($Login) {
	
		$postdata = '';
		
		$URL = $this->apiURL . '/subAccounts/' . $Login . '/unlock';
		
		$ch = $this->createPostRequest($URL, $postdata);
		
		$response = $this->sendRequest($ch);
		
		return $response;
		
	}
	
	/**
	 * Получить список Email шаблонов
	 *
	 * @param string SearchQuery	Cтрока поиска шаблона по имени
	 * @param uint32 Offset			Количество начальных элементов в результате, которые надо пропустить
	 * @param uint32 Limit			Количество элементов, которые необходимо вернуть 
	 * 
	 * @return array
	 */
	function getEmailTemplates ($SearchQuery, $Offset, $Limit) {
		
		$URL = $this->apiURL . '/emailTemplates?searchQuery=' . $SearchQuery . "&Offset=" . $Offset . "&limit=" . $Limit;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	}
	
	/**
	 * Получить Email шаблон по идентификатору
	 *
	 * @param string Id	Идентификатор шаблона
	 *
	 * @return array
	 */
	function getEmailTemplatesId ($Id) {
		
		$URL = $this->apiURL . '/emailTemplates/' . $Id;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
				
		return $response;
	}
	
	/**
	 * Получить Email шаблон по идентификатору
	 *
	 * @param string Name	Имя шаблона
	 *
	 * @return array
	 */
	function getEmailTemplatesName ($Name) {
		
		$URL = $this->apiURL . '/emailTemplates/name/' . $Name;
		
		$ch = $this->createGetRequest($URL);
		
		$response = $this->sendRequest($ch);
		
		return $response;
	}
}


?>