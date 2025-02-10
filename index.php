<?php 
// habilita visualizacao de erros
error_reporting(E_ERROR);
ini_set('display_errors', 1);

// inclui arquivo de funcoes
include('functions.php');

// popula variaveis globais
$cert 					= str_replace('\\','/',__DIR__).'/cert.pem';
$cnpj 					= '12345678000100';
$inscricao_municipal 	= '12345';

// gera numero do RPS
$rps					= date("YmdHis"); 

// monta xml de lote - 01 RPS por lote
$xml = '<?xml version="1.0" encoding="iso-8859-1"?>
<EnviarLoteRpsEnvio xmlns="http://www.abrasf.org.br/ABRASF/arquivos/nfse.xsd">
  <LoteRps id="L'.$rps.'">
    <NumeroLote>'.$rps.'</NumeroLote>
    <Cnpj>'.$cnpj.'</Cnpj>
    <InscricaoMunicipal>'.$inscricao_municipal.'</InscricaoMunicipal>
    <QuantidadeRps>1</QuantidadeRps>
    <ListaRps>
      <Rps>
        <InfRps id="R1'.$rps.'">
          <IdentificacaoRps>
            <Numero>'.$rps.'</Numero>
            <Serie>NF</Serie>
            <Tipo>1</Tipo>
          </IdentificacaoRps>
          <DataEmissao>'.date("Y-m-d").'T'.date("H:i:s").'.703125-03:00</DataEmissao>
          <NaturezaOperacao>52</NaturezaOperacao>
          <OptanteSimplesNacional>2</OptanteSimplesNacional>
          <IncentivadorCultural>2</IncentivadorCultural>
          <Status>1</Status>
          <Servico>
            <Valores>
              <ValorServicos>10.00</ValorServicos>
              <IssRetido>2</IssRetido>
              <ValorIss>0.20</ValorIss>
              <BaseCalculo>10.00</BaseCalculo>
              <Aliquota>0.020</Aliquota>
              <ValorLiquidoNfse>10.00</ValorLiquidoNfse>
            </Valores>
            <ItemListaServico>123</ItemListaServico>
            <CodigoCnae>1234567</CodigoCnae>
            <Discriminacao>Teste</Discriminacao>
            <CodigoMunicipio>4314100</CodigoMunicipio>
          </Servico>
          <Prestador>
            <Cnpj>'.$cnpj.'</Cnpj>
			<InscricaoMunicipal>'.$inscricao_municipal.'</InscricaoMunicipal>
          </Prestador>
          <Tomador>
            <IdentificacaoTomador>
              <CpfCnpj>
                <Cpf>01234567891</Cpf>
              </CpfCnpj>
            </IdentificacaoTomador>
            <RazaoSocial>Fulano de Tal</RazaoSocial>
            <Endereco>
              <Endereco>Rua Uruguaiana</Endereco>
              <Numero>100</Numero>
              <Complemento>100</Complemento>
              <Bairro>Vera Cruz</Bairro>
              <CodigoMunicipio>4314100</CodigoMunicipio>
              <Uf>RS</Uf>
              <Cep>99020250</Cep>
            </Endereco>
            <Contato>
              <Telefone>54991910000</Telefone>
              <Email>seuemail@gmail.com</Email>
            </Contato>
          </Tomador>
        </InfRps>
      </Rps>
    </ListaRps>
  </LoteRps>
</EnviarLoteRpsEnvio>';


// testes das funcoes
echo 'insira os dados no xml e descomente as funcoes para testar...';

// echo emitirNfse($xml);
// echo consultarNfse('20251523'); // numero da nota
// echo consultarNfsePorRps('20250210163106'); // numero do rps
// echo getUrlImpressaoNfse('20251523', '24221158'); // numero da nota, protocolo de emissao
// echo cancelarNfse('20251523'); // numero da nota

?>