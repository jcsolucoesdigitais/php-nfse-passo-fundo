<?php
include('xmlseclibs/xmlseclibs.php');
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;

function consultarNfse($numero='20249040'){
	global $cert;
	global $cnpj;
	global $inscricao_municipal;
	
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSLCERT, $cert);
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://nfse.pmpf.rs.gov.br/thema-nfse/services/NFSEconsulta.NFSEconsultaHttpsSoap11Endpoint/',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://server.nfse.thema.inf.br">
		<soapenv:Header/>
		<soapenv:Body>
			<ser:ConsultarNfse>
				<ser:xml><![CDATA[<?xml version="1.0" encoding="iso-8859-1"?>
	<ConsultarNfseEnvio xmlns="http://www.abrasf.org.br/ABRASF/arquivos/nfse.xsd">
		<NumeroNfse>'.$numero.'</NumeroNfse>
		<Prestador>
			<Cnpj>'.$cnpj.'</Cnpj>
			<InscricaoMunicipal>'.$inscricao_municipal.'</InscricaoMunicipal>
		</Prestador>
	</ConsultarNfseEnvio>]]></ser:xml>
			</ser:ConsultarNfse>
		</soapenv:Body>
	</soapenv:Envelope>',
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: text/xml',
		'SOAPAction: consultarNfse',
		'Charset: iso-8859-1'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;

}

function consultarNfsePorRps($numero='242423'){
	global $cert;
	global $cnpj;
	global $inscricao_municipal;
	
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSLCERT, $cert);
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://nfse.pmpf.rs.gov.br/thema-nfse/services/NFSEconsulta.NFSEconsultaHttpsSoap11Endpoint/',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://server.nfse.thema.inf.br">
    <soapenv:Header/>
    <soapenv:Body>
        <ser:ConsultarNfsePorRps>
            <ser:xml><![CDATA[<?xml version="1.0" encoding="iso-8859-1"?>
<ConsultarNfseRpsEnvio xmlns="http://www.abrasf.org.br/ABRASF/arquivos/nfse.xsd">
    <IdentificacaoRps>
        <Numero>'.$numero.'</Numero>
        <Serie>NF</Serie>
        <Tipo>1</Tipo>
    </IdentificacaoRps>
    <Prestador>
        <Cnpj>'.$cnpj.'</Cnpj>
        <InscricaoMunicipal>'.$inscricao_municipal.'</InscricaoMunicipal>
    </Prestador>
</ConsultarNfseRpsEnvio>]]></ser:xml>
        </ser:ConsultarNfsePorRps>
    </soapenv:Body>
</soapenv:Envelope>',
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: text/xml',
		'SOAPAction: consultarNfsePorRps',
		'Charset: iso-8859-1'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;

}

function cancelarNfse($numero='20141'){
	
	global $cert;
	global $cnpj;
	global $inscricao_municipal;
	
	$xml = '<?xml version="1.0" encoding="iso-8859-1"?>
	<CancelarNfseEnvio xmlns="http://www.abrasf.org.br/ABRASF/arquivos/nfse.xsd">
		<Pedido xmlns="http://www.abrasf.org.br/ABRASF/arquivos/nfse.xsd">
			<InfPedidoCancelamento Id="C'.$numero.'">
				<IdentificacaoNfse>
					<Numero>'.$numero.'</Numero>
					<Cnpj>'.$cnpj.'</Cnpj>
					<InscricaoMunicipal>'.$inscricao_municipal.'</InscricaoMunicipal>
					<CodigoMunicipio>4314100</CodigoMunicipio>
				</IdentificacaoNfse>
				<CodigoCancelamento>E506</CodigoCancelamento>
			</InfPedidoCancelamento>
		</Pedido>
	</CancelarNfseEnvio>';
	$xml = assinarXml($xml);
	$xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://server.nfse.thema.inf.br">
		<soapenv:Header/>
		<soapenv:Body>
			<ser:CancelarNfse>
				<ser:xml><![CDATA['.$xml.']]></ser:xml>
			</ser:CancelarNfse>
		</soapenv:Body>
	</soapenv:Envelope>';
	
	
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSLCERT, $cert);
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://nfse.pmpf.rs.gov.br/thema-nfse/services/NFSEcancelamento.NFSEcancelamentoHttpsSoap11Endpoint/',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>$xml,
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: text/xml',
		'SOAPAction: cancelarNfse',
		'Charset: iso-8859-1'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;

}


function assinarXml($xml){
	global $cert;
	
	$doc = new DOMDocument();
	$doc->loadXML($xml);
	// Create a new Security object 
	$objDSig = new XMLSecurityDSig('');
	// Use the c14n exclusive canonicalization
	$objDSig->setCanonicalMethod(XMLSecurityDSig::C14N);
	// Sign using SHA1
	$objDSig->addReference(
		$doc, 
		XMLSecurityDSig::SHA1, 
		['http://www.w3.org/2000/09/xmldsig#enveloped-signature',
		'http://www.w3.org/TR/2001/REC-xml-c14n-20010315'],
		["force_uri"=>true]
	);
	// Create a new (private) Security key
	$objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type'=>'private'));
	
	//If key has a passphrase, set it using
	//$objKey->passphrase = '<passphrase>';
	
	// Load the private key
	$objKey->loadKey($cert, true);
	// Sign the XML file
	$objDSig->sign($objKey);
	// Add the associated public key to the signature
	$objDSig->add509Cert(file_get_contents($cert));
	// Append the signature to the XML
	$objDSig->appendSignature($doc->documentElement);
	// Save the signed XML
	//$doc->save('./path/to/signed.xml');
	return $doc->saveXML();
}


function emitirNfse($xml){
	global $cert;
	
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSLCERT, $cert);
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://nfse.pmpf.rs.gov.br/thema-nfse/services/NFSEremessa.NFSEremessaHttpsSoap11Endpoint/',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://server.nfse.thema.inf.br">
		<soapenv:Header/>
		<soapenv:Body>
			<ser:RecepcionarLoteRps>
				<ser:xml><![CDATA['.assinarXml($xml).']]></ser:xml>
			</ser:RecepcionarLoteRps>
		</soapenv:Body>
	</soapenv:Envelope>',
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: text/xml',
		'SOAPAction: recepcionarLoteRps',
		'Charset: iso-8859-1'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;

}


function getUrlImpressaoNfse($numero_nfse, $protocolo){
	return 'https://grp.pmpf.rs.gov.br/grp/imprimeNfse?numeroNota='.base64_encode($numero_nfse).'&numeroProtocolo='.base64_encode($protocolo);
}

?>